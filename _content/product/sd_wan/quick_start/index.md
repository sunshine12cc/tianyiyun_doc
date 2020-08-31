---
---

# 光格 SD-WAN 简介

光格 SD-WAN 服务，为企业提供高效便捷的专属广域网组网、智能调度与管理服务，
帮助用户零部署高效率的访问云端关键应用，分钟级构建云、数据中心、企业分支之间的云网一体的专属企业广域网络，
实现三者之间网络任意互联、灵活配置和智能调度，以更低成本获得高品质的网络连接与云端关键应用访问体验。

## 主要概念

为了便于后续使用，简要介绍下光格 SD-WAN 服务涉及的几个概念。

### WAN 网

WAN 网代表一张企业专属 WAN, 不同企业的 WAN 网是100%隔离的。

### 光盒

光盒是光格 SD-WAN 服务的重要接入组件, 便于用户最后一公里快速接入到 WAN 网,
支持公共 Internet 链路、专线、MPLS/VPN、4G LTE 等多种接入方式，可实时监控隧道质量, 
具备零部署，即插即用, 动态链路切换等特性。

### WAN 接入点

WAN 接入点是方便企业将不同类型的网络接入到 WAN 网, 目前支持三种 WAN 接入: 
   
1. 光盒: 允许用户网络通过光盒接入到 WAN 网。

2. 专线: 允许用户网络通过专线(支持 BGP 和静态路由两种方式)接入到 WAN 网。

3. 网关: 允许云平台内 VPC 或主机通过 [边界路由器](https://docs.qingcloud.com/product/network/border) 接入到 WAN 网。


## 快速入门指南

如下指南可帮助用户快速上手光格 SD-WAN。

* [光盒连 VPC](cpe_connect_vpc.html)
* [专线连 VPC](line_connect_vpc.html)
* [VPC 跨区连 VPC](vpc_connect_vpc.html)
* [光盒通过VPC和其他VPC建立隧道](cpe_connect_tunnel.html)
* [专线连接VPC转接外网](line_connect_eip.html)
* [基于光盒目录添加内网路由策略](cpe_directory.html)