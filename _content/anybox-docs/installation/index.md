---
---

# 安装

## 创建AnyBox

在青云QingCloud 公有云上，您可以便捷、快速地创建和管理一个 ANYBOX 内容协作平台。平台将运行于您的私有网络内，结合青云QingCloud 对象存储，在保障高性能的同时兼顾您的数据安全。

## 准备工作

在创建 ANYBOX 内容协作平台之前，需要您做好如下准备工作：

为了保障数据安全，ANYBOX  内容协作平台需要运行在受管私有网络中。在创建 ANYBOX 内容协作平台之前，您需要创建一个 VPC 和一个受管私有网络， 若还未创建请参考 [创建 VPC](https://docs.qingcloud.com/product/network/vpc) 和 [创建私有网络](https://docs.qingcloud.com/product/network/appcenter_network_config/create_vxnet)。受管私有网络需要加入VPC，并开启 DHCP 服务（默认开启）：

**创建 VPC，如下图：**  

![](https://anybox-docs.pek3b.qingstor.com/installation/images/images01.jpg)

**创建私有网络，如下图：**  
![](https://anybox-docs.pek3b.qingstor.com/installation/images/images02.jpg)

**为 VPC 设置端口转发策略**  
网络与 CDN ‣ VPC 网络 ‣ 选中 VPC 网络 ‣ 进入详情页，见下图步骤：  
![](https://anybox-docs.pek3b.qingstor.com/installation/images/images03.jpg)

管理配置‣ 添加规则 ‣ 填写端口转发规则 ‣ 提交 ‣ 应用修改， 见下图步骤：  
![](https://anybox-docs.pek3b.qingstor.com/installation/images/images04.jpg)

**申请公网 IP**  
首先需申请公网 IP 地址，网络与 CDN ‣ 公网 IP ‣ 申请 ‣ 填入公网 IP 名称 ‣ 提交，见下图步骤：  
![](https://anybox-docs.pek3b.qingstor.com/installation/images/images05.jpg)

绑定公网 IP 到 VPC，网络与 CDN ‣ 公网 IP ‣ 选中公网 IP ‣ 绑定到 VPC 网络 ‣ 提交，见下图步骤：  
![](https://anybox-docs.pek3b.qingstor.com/installation/images/images06.jpg)

**配置防火墙**  
默认情况下 AppCenter 集群的端口是全部打开的，所以我们只需要配置 VPC 网络的防火墙，确保源端口流量可以通过。见下图步骤：  
![](https://anybox-docs.pek3b.qingstor.com/installation/images/images07.jpg)


添加规则 ‣ 填写信息 ‣ 提交 ‣ 应用修改， 见下图步骤：  
![](https://anybox-docs.pek3b.qingstor.com/installation/images/images08.jpg)

资源配置说明：默认需要添加防火墙规则，允许80端口通过，在配置防火墙转发策略时，不需要填写目的IP/源IP（不写公网IP），另，VPC转发策略需要指向端口到内网IP上，并应用修改才会生效。

**预先创建 API 密钥，如下图：**  
![](https://anybox-docs.pek3b.qingstor.com/installation/images/images09.jpg)

从如上图的菜单中进入创建API密钥页面
![](https://anybox-docs.pek3b.qingstor.com/installation/images/images10.jpg)

选择创建即可新建API密钥

**为了更好地方便您使用 ANYBOX 内容协作平台，需要准备一个已备案的域名。**  
如果您的域名还未备案，请参考 [ICP 备案](https://beian.qingcloud.com/icp) 申请备案。

## 立即部署
点击 [ANYBOX 内容协作平台](https://appcenter.qingcloud.com/apps/app-m2cz7dcs/ANYBOX%20%E5%86%85%E5%AE%B9%E5%8D%8F%E4%BD%9C%E5%B9%B3%E5%8F%B0)，进入 ANYBOX 应用页，如下图 ：  
![](https://anybox-docs.pek3b.qingstor.com/installation/images/images11.jpg)

点击“立即部署”，开始部署 ANYBOX 内容协作平台。（如未登录会显示登录后部署，请使用 QingCloud 账号、密码登录）

## 选择区域  
在创建 ANYBOX 时，您需要选择平台部署所在的区域（就近选择即可），如下图：  
![](https://anybox-docs.pek3b.qingstor.com/installation/images/images12.jpg)

## 选择基本配置
在创建界面中，需要填写名称 (可选)，以及选择计费方式，推荐选择按月计费。如下图：  
![](https://anybox-docs.pek3b.qingstor.com/installation/images/images13.jpg)

## 主节点资源配置

您可根据自身需求（企业中使用人数）选择配置主节点，请根据需要选择 ANYBOX 主节点的 CPU、内存、主机资源类型和磁盘资源类型、磁盘空间。  

**资源推荐配置：**
> - 默认最低配置推荐：100人及以下 4核8G，100以上选用 8核16G ；
> - 主机资源类型推荐：基础型；
> - 磁盘资源类型推荐：基础型；
> - 磁盘空间：50GB；

（以上配置为本次活动代金券支持的默认配置，选择更高配置可能会加速代金券消费，从而不足以支持原定3/6个月的免费使用周期）  

![](https://anybox-docs.pek3b.qingstor.com/installation/images/images14.jpg)

## 网络设置
选择集群主机所在的私有网络，私有网络需要在创建集群前准备好。如下图：  
![](https://anybox-docs.pek3b.qingstor.com/installation/images/images15.jpg)

## 服务环境参数设置
(1) 为了更好地方便您使用 ANYBOX 内容协作平台，需要您填写 ANYBOX 访问的相关域名。
> - 主域名：访问anybox的入口域名（例如： `anybox.com`）
> - account服务域名：登陆时使用的域名（例如： `account.anybox.com`）
> - 控制台域名：进入管理控制台的域名（例如： `admin.anybox.com`）
> - api服务域名：内部及app使用（例如：`api.anybox.com`）

注意：因为通过公网访问Anybox服务，因国家法规规定需要使用已备案的域名，也可以使用二级/三级子域名（是在主域名的前面添加自定义名称），示例说明  

例如域名：`dns-example.com`：  
`dns-example.com` 是主域名（也可称托管一级域名），主要指企页名  

`example.dns-example.com` 是子域名（也可称为托管二级域名）  

`www.example.dns-example.com` 是子域名的子域（也可称为托管三级域名）   

同时，需要您将准备好的备案域名解析到申请好的公网 IP 地址上。
以上4个域名用户可以定制, 但是主域名必须一致. 域名确定后无法修改。如下图：  

![](https://anybox-docs.pek3b.qingstor.com/installation/images/images16.jpg)

(2) ANYBOX 需要 API 密钥来调用 QingCloud 对象存储 API。请在控制台生成 API 密钥。  

## 创建成功
当 ANYBOX 创建完成之后，您可以查看每个节点的运行状态。当节点的服务状态显示为“正常”状态，表示该节点启动正常。 当每个节点都启动正常后 ANYBOX 主节点显示为“活跃”状态，表示您已经可以正常使用 ANYBOX 服务了。如下图：  
![](https://anybox-docs.pek3b.qingstor.com/installation/images/images17.jpg)

## 使用 ANYBOX
(1)  ANYBOX 内容协作平台创建完成之后可以进行测试，打开浏览器, 输入 `http://主域名.com` 进入ANYBOX服务，跳转至 ANYBOX 登录页面；  
(2)  使用默认登陆管理员：root；密码：7imiDPW0F0QZp0smM29k 登录，登录后请到控制台成员管理下重置密码，如提示输入企业名, 请输入：enterprise  
(3)  登录成功后，您就可以开始管理/使用 ANYBOX 内容协作平台提供的服务了，更加详细的使用说明请参看 ANYBOX内容协作平台-用户/管理员操作手册  

联系技术支持: 17607177530（周工）










