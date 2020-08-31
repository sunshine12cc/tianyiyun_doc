---
---

# Inference Engine 用户指南


## 简介

训练和推理是机器/深度学习的两个重要组成部分。用户利用加速器 ( CPU/GPU/FPGA) 通过各种深度学习框架如 Tensorflow, PyTorch 等训练好模型后，将模型部署到生产环境、管理模型版本并提供 API 用于推理，是机器/深度学习产生价值的不可或缺的环节。



一个成熟的推理产品除了要支持多种推理框架、多种加速器（CPU/GPU）之外，还需要支持诸如推理 API (HTTP/GPRC) 负载均衡、模型上传、模型存储、模型部署、水平/垂直伸缩、推理引擎日志/推理 API 访问日志查看等诸多功能。



Inference Engine 旨在解决上述问题，给用户提供一站式的模型部署与推理方案，并为以后模型市场的推出打下坚实的基础，具体来讲包括：

- 一键部署、灵活易用。用户仅需要上传模型，设置模型名称即可快速拥有生产环境可用的 AI 推理引擎。

- 支持目前比较主流的推理框架: Tensorflow Serving / ONNX Runtime / OpenVINO 

  > v1.0 版仅支持 针对 Intel CPU 优化过的 CPU 版的 Tensorflow Serving , 陆续会推出更多推理框架的支持

- 支持多种加速器 CPU、GPU 等。值得一提的是当前 Inference Engine 用到的 CPU 是第二代 Intel 至强可扩展处理器 ( CascadeLake ) ，因其采用了 Intel DeepLearning Boost VNNI 技术，AI 推理性能和较老型号的 CPU  相比有接近 100% 的提升 (详见性能测试部分)。不同于训练阶段，配合针对 CPU 优化过的框架，CPU 可以在推理环节发挥更重要的作用，与 GPU 相比可以给用户提供更低成本的选择。

  > 目前第二代 Intel 至强可扩展处理器 ( CascadeLake ) 在 pek3 及 sh1 区各 zone 均有部署， 推荐在这两个区部署 Inference Engine 推理引擎。在其他区部署将使用较老型号的 CPU。

- 支持通过云原生技术 Envoy 进行高效的 HTTP 和 GRPC 推理 API 的负载均衡，用户只需配置好需要暴露的 HTTP/GRPC 端口即可。

- 支持多种模型存储方式包括：本地磁盘存储、S3 对象存储、兼容 S3 协议的 MinIO 私有对象存储

- 支持多种部署方式：试验性单节点部署（利用本地磁盘作为模型库）、私有云多节点部署（利用 MinIO 作为模型库）、公有云多节点部署（利用 QingStor 对象存储作为模型库）

- 支持水平/垂直扩容和缩容

- 支持引擎运行日志查看和推理 API 访问日志查看

  



## 架构

![Inference Engine 架构](images/architecture.jpg)



如上图所示，Inference Engine 由三种角色构成：

- 边缘代理/负载均衡器 ( Edge Proxy & Load Balancing ) : 采用云原生技术栈里的 Envoy 用作边缘代理和负载均衡器

- 模型服务 ( Model Serving ) : 加载模型并提供 HTTP/GRPC 推理服务的引擎，这里以 Tensorflow Serving 举例

- 模型库 ( Model Repo ) : 用于存储训练好的模型。用户既可以使用能私有部署、适用于私有云等不能访问外网环境并且兼容 S3 协议的私有对象存储 MinIO，也可以使用公有云兼容 S3 协议的对象存储比如 QingStor 对象存储， 来存储模型并供模型服务加载。此外，用户也可以上传模型到模型服务节点本地磁盘相应目录，并加载到 Tensorflow Serving，用做单节点试验用。

  > 需要注意的是 Inference Engine 虽然包含三种角色，但部署时只有模型服务 ( Model Serving ) 和模型库 ( Model Repo ) 两种类型的节点，在这两种类型的每个节点中都会包含 Envoy 用作边缘代理和负载均衡的用途。所以用户的推理请求可以发送到两种类型的任一节点，该节点的 Envoy 会将其负载均衡的分发到所有模型服务节点





## 部署

如前所述，Inference Engine 有 3 种部署方式：

- 单模型服务节点 + 本地模型存储
- 多模型服务节点 + 私有对象存储模型库 ( MinIO 对象存储 )
- 多模型服务节点 + 公有云对象存储模型库  ( QingStor 对象存储或其他兼容 S3 协议的公有云对象存储)

> 3 种部署方式部署的各种角色的节点均可通过 ```root``` 或 ```ubuntu``` 用户以密码 ```p12cHANgepwD``` 访问



### 方式一：单模型服务节点 + 本地模型存储

本部署方式只部署一个模型服务节点，模型保存在该模型服务节点的本地系统盘，无需部署模型库节点。

仅适用于试验性用途或者低访问量的情况。

- 服务详情

![单服务节点](images/1.1-single_node.png)

- 模型存储

  模型存储在模型服务节点的 /data/models 目录下，内置了 resnet 和 Tensorflow 官方演示模型 saved_model_half_plus_two_mkl 两个模型

![本地模型存储](images/1.1.1-models.png)

- 服务配置

  此种部署方式需要将配置参数的 s3.type 设为 none

![服务配置](images/1.1.2-single_node_config.png)





### 方式二：多模型服务节点 + 私有对象存储模型库

本部署方式部署多个模型服务节点以及一个模型库节点，模型保存在模型库节点的 MinIO 对象存储中。

适用于无法访问公网的私有云部署或没有公有云对象存储访问权限的场景。

- 服务详情

![多服务节点+模型存储库](images/1.2-with_modelrepo.png)

- 模型存储

  模型保存在 MinIO 对象存储中，MinIO 对象存储的模型存储路径为 /data/minio/data/models 目录，内置了 resnet 和 Tensorflow 官方演示模型 saved_model_half_plus_two 两个模型。可以直接用 linux 文件系统命令将模型拷贝到 MinIO 的模型存储目录中，也可以使用 s3cmd 来管理 MinIO 中的数据，用法详见 [s3cmd 命令详解](https://docs.min.io/docs/s3cmd-with-minio.html) 。

![模型存储库](images/1.2.2-models.png)

- 服务配置

  此种部署方式需要将配置参数的 s3.type 设为 minio
  
  > 注：MinIO 的 access key 默认为 `AKIAIOSXODNN7EXAMPLE` 
  >
  > ​                        secret key 默认为 `wJalrXUtqFEMI/K7MDENG/bPxRfiCYEXAMPLEKEY`
  >
  > ​		二者均可以通过配置参数 s3.access.key 和 s3.secret.key 设为用户自定义的 key

![服务配置](images/1.2.1-with_modelrepo_config.png)





### 方式三：多模型服务节点 + 公有云对象存储模型库

本部署方式部署多个模型服务节点，本地不部署模型库节点，模型保存在 QingStor 对象存储模型库中。

适用于可以访问公网，并有公有云对象存储访问权限的场景，模型存储成本相对较低。

- 服务详情

![多服务节点+公有云对象存储](images/1.3.1-qingstor.png)

- 模型存储

  模型保存在公有云对象存储中，比如模型放在 QingStor 对象存储的 Bucket  `models` 中，则模型库根目录就要设为 s3://models 
  
  > 注：s3://models 为青云公开的模型存储库，s3://datasets 为青云公开的数据集
  >
  > 任何青云用户都可以用自己的 key 访问，或者直接访问url 比如 http://datasets.pek3b.qingstor.com/test/cat.jpg

![模型存储库](images/1.3.3-qingstor-bucket1.png)

![模型存储库](images/1.3.3-qingstor-bucket2.png)

![模型存储库](images/1.3.3-qingstor-bucket3.png)

- 服务配置

  此种部署方式需要将配置参数的 s3.type 设为 QingStor , 并更改相应的 access/secret key 为自己的 key

![服务配置](images/1.3.2-qingstor-config.png)

> 注：s3.type 设为 QingStor 并设置相应的 key 后, QingStor 对象存储也可以用 s3cmd 访问，用法详见 [s3cmd 命令详解](https://docs.min.io/docs/s3cmd-with-minio.html) 。
>
> ![s2cmd](images/1.3.4-qingstor-s3cmd.png)





###  部署步骤



#### 第 1 步：选择版本

![version](images/2-deploy1.png)



#### 第 2 步：模型服务节点配置

模型服务节点会自动选择当前区最新的 CPU 用于推理，pek3 及 sh1 区均为具有推理加速能力的 CascadeLake

![model_serving](images/2-deploy2.png)



#### 第 3 步：模型库节点配置

![version](images/2-deploy3.png)



#### 第 4 步：网络设置

![version](images/2-deploy4.png)



#### 第 5 步：服务环境参数设置

- model.name 

  该参数为模型名称，将被用作存储模型的目录名以及推理 API 的路径名：

  ```shell
  # 模型存储在本地磁盘
  /data/models/saved_model_half_plus_two_mkl
  /data/models/resnet
  # 调用模型 saved_model_half_plus_two_mkl 的 HTTP API
  curl -d '{"instances": [1.0, 2.0, 5.0]}' -X POST http://<Any Node IP>:8080/v1/models/saved_model_half_plus_two_mkl:predict
  # 调用 resnet 模型的 HTTP API
  curl -d '{"instances": ["b64":"<base64 encode picture>"]}' -X POST http://<Any Node IP>:8080/v1/models/resnet:predict 
  ```

- model.base.path

  模型库根目录，仅用于将对象存储用作模型库时：

  ```shell
  # 模型存储在对象存储
  s3://models/saved_model_half_plus_two_mkl
  s3://models/resnet
  ```

- http.port/grpc.port

  模型 HTTP/GRPC 服务暴露端口 , 需要注意的是不能设为 8500 及 8501 这两个 Tensorflow serving 保留端口
  
- enable.access.log

  打开此开关将能查看推理 HTTP/GRPC API 的访问日志，可以看到每个推理请求由后端哪个节点处理。

![version](images/2-deploy5.png)



## 使用指南

### 部署模型

Inference Engine 中各节点的本地磁盘、私有对象存储 MinIO 、QingStor 对象存储中均内置了两个模型，默认加载的是 saved_model_half_plus_two_mkl：

- Tensorflow 官方演示模型 saved_model_half_plus_two_mkl
- resnet

用户可以通过修改 model.name 配置参数切换到其他模型。如果用户需要加载自己的模型，步骤如下：

- 上传模型到对象存储相应 bucket 比如 s3://models , 或者模型服务节点本地磁盘的 /data/models 目录

- 修改 models.name 参数为上传的模型目录名

  > 上传目录到对象存储通过 [s3cmd](https://docs.min.io/docs/s3cmd-with-minio.html) 命令，如下命令将本地的文件夹 /data/models/resnet 同步到 s3://models/ 目录下
  >
  >  ```s3cmd sync /data/models/resnet s3://models/ ```





###  使用模型

通过上述方式部署好模型后，即可通过调用 HTTP/GRPC API 来使用模型。和 HTTP 相比，GRPC 具有更好的性能，推荐使用 GRPC API .

- HTTP 推理 API 调用

  HTTP 推理 API 的格式为: 

  ```http://<Any Node IP>:8080/v1/models/<model name>:predict```

  比如内置的两个模型可以分别通过如下 HTTP API 进行调用：

  ```shell
  # saved_model_half_plus_two_mkl 的 HTTP API 调用方法
  curl -d '{"instances": [1.0, 2.0, 5.0]}' -X POST http://<Any Node IP>:8080/v1/models/saved_model_half_plus_two_mkl:predict
  
  # resnet 模型的 HTTP API 的格式
  curl -d '{"instances": ["b64":"<base64 encode picture>"]}' -X POST http://<Any Node IP>:8080/v1/models/resnet:predict 
  
  # 为了方便测试 resnet 的 HTTP API，可通过如下方式：
  cd /opt/app/test
  source tfserving_venv/bin/activate
  python resnet_client.py
  deactivate
  ```

- GRPC 推理 API 调用

  调用 GRPC API 通常需要自己编写 client 程序，可参考下面 resnet 的例子：

  ```shell
  # 调用 resnet 模型的 GRPC API，可通过如下方式：
  cd /opt/app/test
  source tfserving_venv/bin/activate
  python resnet_client_grpc.py
  deactivate
  ```





###  查看日志

访问任意节点的 8090 端口可以查看 Tensorflow serving , Envoy 的运行日志，还可以浏览本地存储的模型。

```<Node IP>:8090```

![log2](images/3-log2.png)

![log3](images/3-log3.png)

![models](images/3-models1.png)



####  推理引擎日志

推理引擎的日志保存在 ```tensorflow_serving.log``` 中



####  推理 API 访问日志

打开配置参数中的 ```enable.access.log``` 开关后，将能查看推理 HTTP/GRPC API 的访问日志，可以看到每个推理请求由后端哪个节点处理，如果有多个模型服务节点，则将会看到推理请求会负载均衡的分配到各节点处理，该日志保存在推理请求访问节点的 ```envoy.log``` 中。

如下图所示 HTTP/GRPC 推理请求被负载均衡的分配到集群的 3 个模型服务节点中去：

![envoy.log](images/5-accesslog.png)



###  性能测试

从下面的性能测试可以看出，全新推出的第二代 Intel 至强可扩展处理器 ( CascadeLake ) 因采用了 Intel DeepLearning Boost VNNI 技术，AI 推理性能和较老型号的 CPU Broadwell 相比有接近 100% 的提升。

> 目前第二代 Intel 至强可扩展处理器 ( CascadeLake ) 在 pek3 及 sh1 区各 zone 均有部署， 推荐在这两个区部署 Inference Engine 推理引擎。在其他区部署将使用较老型号的 CPU。

| 运行环境       | CPU               | Memory | GPU  | BatchSize | 分类 | Images/Sec(Step tIme) |
| -------------- | ----------------- | ------ | ---- | --------- | ---- | --------------------- |
| CPU (MKL 优化) | 16核(Broadwell)   | 32G    | 0    | 32        | 推理 | 48.65 (20.55ms)       |
| CPU (MKL 优化) | 16核(CascadeLake) | 32G    | 0    | 32        | 推理 | 88.95 (11.24ms)       |



###  负载均衡

Inference Engine 的负载均衡由云原生技术 Envoy 实现，其每种角色的每个节点均运行着有着相同配置的 Envoy，因此用户的推理请求可发送到到任意节点，Envoy 将会把该节点收到的 HTTP/GRPC 推理请求负载均衡的转发到模型服务的各节点。Envoy 的配置可通过在浏览器中输入 ```<Node IP>:8001```访问：

- 访问 ```<Node IP>:8001``` 可查看 Envoy 的所有配置情况

![envoy_config](images/6-envoy_mgmt.png)

- 访问 ```<Node IP>:8001/clusters``` 可以看到 envoy 后面具体由哪些模型服务节点提供推理服务，下图是一个由 3 个模型服务节点组成的集群

  ![envoy_config_clusters](images/6-envoy_clusters.png)