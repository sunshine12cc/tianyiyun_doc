---
---

# 公有云接入

本文档介绍了如何使用青立方超融合易捷版的**公有云接入服务**与 [QingCloud 公有云](https://console.qingcloud.com) 的 VPC 互联。

## 功能说明

公有云接入服务提供一种便捷对接 QingCloud 公有云的能力。结合 QingCloud 光格 SD-WAN，将您的超融合服务器变身为 光格 SD-WAN 的接入设备光盒，以零部署的方式帮助用户接入云端，分钟级构建公有云与本地分支之间的专属网络。

## 主要概念

为了便于后续使用，简要介绍公有云接入服务所涉及的几个概念。

> - 光格 SD-WAN <br>
> 光格网络 SD-WAN 是 QingCloud 环境内为企业提供高效的广域网接入、多地组网及智能调度与管理服务，帮助用户零部署接入动态多线 BGP 网络以访问云端关键应用，分钟级构建云、数据中心、企业分支之间的专属网络，实现三者之间网络任意互联、灵活配置和智能调度，以更低成本获得高品质的网络连接与云端关键应用访问体验。
>
> - 光盒 <br>
> 光盒是光格 SD-WAN 服务的重要接入组件, 便于用户最后一公里快速接入到 WAN 网，可实时监控隧道质量, 动态链路切换等特性。
>
> - 网关 <br>
> 光盒是光格 SD-WAN 服务的重要接入组件, 允许云平台内 VPC 或主机通过 内网路由器 接入到 WAN 网。
>
> - 内网路由器 <br>
> 内网路由器可高速连通同区域下不同 VPC 中的私有网络, 也可以通过光格 SD-WAN 中的网关接入点接入到 WAN 网。
>
> - VPC <br>
> VPC 网络是 QingCloud 环境内可以为用户预配置出的一个专属的大型网络。在 VPC 网络内，您可以自定义 IP 地址范围、创建子网，并在子网内创建主机/数据库/大数据等各种云资源。

## 前提条件

在尝试此配置之前，请确保满足这些要求。

### 要求一

1、了解如何创建 VLAN 
2、要求本地网络具备连接外网的能力（internet网络）
3、需要预先在物理交换设备上划分三个或以上用于青立方超融合易捷版公有云接入业务需要使用的 VLAN，其中一个 VLAN 需要有外网访问能力，并在青立方 “IP池” 管理功能中，添加好相应信息（包括 IP 网段，VLAN-ID）。


### 要求二

要求配置云端 光格 SD-WAN & VPC 业务，需熟悉这两种服务的使用，可参考：

- [光格 SD-WAN 官方文档](https://docs.qingcloud.com/product/sd_wan/quick_start/#%E5%85%89%E6%A0%BC-sd-wan-%E7%AE%80%E4%BB%8B)
- [QingCloud VPC 官方文档](https://docs.qingcloud.com/product/network/vpc)

## 公有云接入配置指南

### 网络拓扑图

本指南使用的网络设置拓扑图如下所示。

![](https://pek3b.qingstor.com/kubesphere-docs/png/20190711191529.png)

在此图中，在本地物理交换设备定义了三个VLAN

* VLAN 1000  网段：172.31.46.0/24
* VLAN 2000  网段：139.198.255.33/25  [具备访问外网的能力] 
* VLAN 3000  网段：172.31.45.128/25  [网关IP：172.31.45.254]

### 第一步：进入公有云接入页面

登录青立方，顶部选择 「公有云接入」，进入公有云接入页面，点击 「立即部署」。

![](https://pek3b.qingstor.com/kubesphere-docs/png/20190711191617.png)

### 第二步：查看步骤引导

了解公有云接入服务的基本步骤，然后点击 「已了解，下一步」。

![](https://pek3b.qingstor.com/kubesphere-docs/png/20190711191637.png)

### 第三步：启用虚拟光盒

准备激活并配置云端光格 SD-WAN 服务。

![](https://pek3b.qingstor.com/kubesphere-docs/png/20190711191738.png)

3.1. 点击 「已在云端配置成功，下一步」 启用本地光盒。

![](https://pek3b.qingstor.com/kubesphere-docs/png/20190711191802.png)

3.2. 选择本地交换设备定义好的具备外网访问能力的 VLAN2000 为虚拟光盒的 `WAN 口` 网络 IP。

![](https://pek3b.qingstor.com/kubesphere-docs/png/20190711191819.png)

3.3. 选择定义好的其中一个 VLAN 3000 段为 `LAN口` 网络 IP。

![](https://pek3b.qingstor.com/kubesphere-docs/png/20190711191855.png)

3.4. 在青立方复制生成的虚拟光盒序列号。

![](https://pek3b.qingstor.com/kubesphere-docs/png/20190711191923.png)

### 第四步：公有云激活虚拟光盒

4.1. 进入 QingCloud 公有云 提交工单激活公有云接入服务生成的虚拟光盒序列号

![](https://pek3b.qingstor.com/kubesphere-docs/png/20190711191957.png)

4.2. 待激活成功后，进入 QingCloud 公有云办理光盒入网。

![](https://pek3b.qingstor.com/kubesphere-docs/png/20190711192019.png)

4.3. 填写已激活后的序列号，并选择好服务所需要的带宽。

![](https://pek3b.qingstor.com/kubesphere-docs/png/20190711192039.png)

4.4. 点击提交后，办理入网成功。

![](https://pek3b.qingstor.com/kubesphere-docs/png/20190711192105.png)

### 第五步：配置本地与云端路由通信

5.1. 入网成功有回到本地环境，点击 「已在云端配置成功，下一步」。

![](https://pek3b.qingstor.com/kubesphere-docs/png/20190711192127.png)

5.2. 添加本地路由转发，选择本地需要与云端互通的本地路由，本指南选择了 VLAN1000 做为与云端互通的本地网络。

![](https://pek3b.qingstor.com/kubesphere-docs/png/20190711192155.png)

>注意：本指南划分了 3 个 VLAN 用作示例，本地与云端互通的网络需要排除 WAN 口 和 LAN 口 使用的 VLAN 2000 和 VLAN 3000。本指南选择了 VLAN1000 做为与云端互通的本地网络 ，配置成功后 VLAN1000 下的所创建的虚拟主机均与云端互通。

5.3. 填写目标网络，目标网络填写虚拟光盒 LAN 口所在 VLAN3000（本指南）的网关地址：`172.31.45.254`。

![](https://pek3b.qingstor.com/kubesphere-docs/png/20190711192217.png)

### 第六步：配置参照表

6.1. 根据配置参照表配置云端虚拟光盒的 LAN 口设置并设置静态路由。点击 「部署成功，下一步」，平台将根据本地端设置自动生成的云端 `[配置参照表]` 。

![](https://pek3b.qingstor.com/kubesphere-docs/png/20190711193122.png)

6.2. 进入 [QingCloud 公有云](https://console.qingcloud.com) 的已办理 SD-WAN 入网的虚拟光盒详情页面修改配置。

![](https://pek3b.qingstor.com/kubesphere-docs/png/20190711193139.png)
![](https://pek3b.qingstor.com/kubesphere-docs/png/20190711193154.png)

6.3. 将虚拟光盒 LAN 配置内网段 & 网关 IP 更改为与上述 `[配置参照表]` 内提供的一致。

![](https://pek3b.qingstor.com/kubesphere-docs/png/20190711193212.png)

6.4. 添加光盒的静态路由，路由信息跟上述 `[配置参照表]` 内提供的一致。

![](https://pek3b.qingstor.com/kubesphere-docs/png/20190711193231.png)

>注意：配置之后需要点击 “应用修改” 以生效。

### 第七步：光盒连接 VPC 私有网络

>光格网络 SD-WAN 提供了光盒连接VPC的能力，本指南约定 用户已在云端VPC网络创建了虚拟机，并部署好云端的业务。本次操作提供通过本地环境通过SD-WAN光格网络与云端VPC私有网络下主机连通。

图示简单展示了本次操作所构建的网络拓扑。

![](https://pek3b.qingstor.com/kubesphere-docs/png/20190711193252.png)

7.1 创建网关接入点

![](https://pek3b.qingstor.com/kubesphere-docs/png/20190711193311.png)

7.2. 在当前页面快捷创建内网路由器

![](https://pek3b.qingstor.com/kubesphere-docs/png/20190711193338.png)
![](https://pek3b.qingstor.com/kubesphere-docs/png/20190711193401.png)
![](https://pek3b.qingstor.com/kubesphere-docs/png/20190711193420.png)

7.3. 创建成功后，关联需要与本地业务互通的VPC私有网络

![](https://pek3b.qingstor.com/kubesphere-docs/png/20190711193438.png)
![](https://pek3b.qingstor.com/kubesphere-docs/png/20190711193454.png)

7.4. 选择好服务所需要带宽，点击提交即创建成功

![](https://pek3b.qingstor.com/kubesphere-docs/png/20190711193514.png)
![](https://pek3b.qingstor.com/kubesphere-docs/png/20190711193531.png)

7.5. 进入光盒列表，点击右键添加内网路由策略

![](https://pek3b.qingstor.com/kubesphere-docs/png/20190711193549.png)

7.6. 选择前面 创建网关 步骤中已创建好网关绑定的 VPC 私有网络

![](https://pek3b.qingstor.com/kubesphere-docs/png/20190711193606.png)
![](https://pek3b.qingstor.com/kubesphere-docs/png/20190711193626.png)

7.7. 选择后点击提交并前往VPC页面进行应用修改

![](https://pek3b.qingstor.com/kubesphere-docs/png/20190711193643.png)
![](https://pek3b.qingstor.com/kubesphere-docs/png/20190711193721.png)
![](https://pek3b.qingstor.com/kubesphere-docs/png/20190711193739.png)

7.8. 继续在当前页面添加内网路由策略规则，目标网络为设置好的本地与云端互通的网段。本指南选择了 VLAN1000 做为与云端互通的本地网络：VLAN1000 `172.31.46.0/24`

![](https://pek3b.qingstor.com/kubesphere-docs/png/20190711193758.png)
![](https://pek3b.qingstor.com/kubesphere-docs/png/20190711193813.png)

>注意：配置之后需要点击“应用修改”以生效

7.9. 在出口设备里添加虚拟光盒LAN口的路由设置，目标网络选为云端需要与本地互通的 VPC 私有网络。

>**配置本指南示例需要回顾的基本信息**
>虚拟光盒的 LAN 口 IP 地址：`172.31.45.240`
>需要与本地互通的 VPC 私有网络为：`192.168.12.0/24`

在出口设备内添加路由信息：**目标网络 192.168.12.0/24  下一跳 172.31.45.240**

7.10. 本地与云端通信路由均设置完成后，点击 「下一步」。

![](https://pek3b.qingstor.com/kubesphere-docs/png/20190711193836.png)


### 第八步：测试本地业务与云端业务连接

**本地与云端业务互通测试与监控需要准备如下条件：**

- 与云端互通的本地网络下虚拟主机 ID，本指南设置的为 VLAN 1000  网段：172.31.46.0/24 与云端互通
- 云端与本地互通的VPC私有网络下虚拟主机 IP，本指南设置与本地互通的 VPC 私有网络：`192.168.99.0/24` 

8.1. 复制云端VPC私有网络下主机 IP 地址用作连接测试监控。

![](https://pek3b.qingstor.com/kubesphere-docs/png/20190711193901.png)

8.2. 回到本地环境添加本地和云端监控的主机 ID 与 IP。

![](https://pek3b.qingstor.com/kubesphere-docs/png/20190711193917.png)

8.3. 点击「开始检测」，测试通过后完成所有部署。

![](https://pek3b.qingstor.com/kubesphere-docs/png/20190711193931.png)

8.4. 本地业务与云端业务连接成功。

![](https://pek3b.qingstor.com/kubesphere-docs/png/20190711193948.png)
![](https://pek3b.qingstor.com/kubesphere-docs/png/20190711194003.png)




