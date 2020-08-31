---
---

# 专线连 VPC

本篇指南旨在帮助用户使用光格 SD-WAN 服务实现专线客户端与云平台 VPC 私有网络主机网络互通。 

## 总览

下图展示了本指南所要构建的网络拓扑。

![](../_images/line_connect_vpc_topology.png)

## 操作

第一步: 创建 WAN 网。


WEB 控制台，点击左边导航条中的“光格 SD-WAN”，接着在右边区域点击“创建企业广域网”按钮, 输入名称即可创建专属 WAN 网。

[![](../_images/create_wan_net.png)](../_images/create_wan_net.png)

    注意：此步骤只针对首次使用光格 SD-WAN 服务的用户。

第二步: 创建专线接入点。


WEB 控制台，点击左边导航条中的“光格 SD-WAN -> 总览”, 接着在右边区域点击"创建接入点", 选择"专线"类型并填入相应的信息即可。

[![](../_images/create_wan_line.png)](../_images/create_wan_line.png)

创建好的专线接入点, 状态是审核中。当完成审核、专线链路施工后, 用户才可以进行路由配置。目前支持 BGP 和静态路由两种方式。

    注意：对于BGP和静态路由两种方式, 在配置前请慎重选择, 一旦配置不可切换

第三步: 配置专线。


当完成审核、专线链路施工后, 用户可以配置专线。本指南以静态路由方式为例, 如下所示, 指定静态路由即可。

[![](../_images/config_wan_line_route.png)](../_images/config_wan_line_route.png) 

第四步: 创建边界路由器。


WEB 控制台，点击左边导航条中的“网络与 CDN -> 边界路由器”, 点击"创建"即可创建边界路由器。

[![](../../network/_images/intranet_router.png)](../../network/_images/intranet_router.png)

第五步: 将 VPC 私有网络关联到边界路由器。


点击创建好的边界路由器进入边界路由器详情页, 然后点击"关联 VPC 私有网络", 选择主机所在私有网络以关联边界路由器。

[![](../_images/intranet_router_vxnet2.png)](../_images/intranet_router_vxnet2.png)

第六步: 为 VPC 私有网络配置内网路由器策略。


在边界路由器详情页, 点击"路由设置", 进入到内网路由策略配置页面, 设置内网路由策略。

[![](../_images/intranet_router_detail_rule.jpg)](../_images/intranet_router_detail_rule.jpg)

    注意：
    1. 内网路由策略中的边界路由器类型选物理边界路由器。
    2. 内网路由策略中的目标网段设置为专线客户端所在的网段。
    3. 设置好内网路由策略后,需要点击"应用修改＂以生效。

第七步: 创建网关接入点。


WEB 控制台， 点击左边导航条中的“光格 SD-WAN -> 总览”, 接着在右边区域点击"创建接入点", 
选择"网关"类型, 并选择刚才配置的边界路由器, 然后填入相应信息即可创建网关接入点。

[![](../_images/create_vpc_wan_access.png)](../_images/create_vpc_wan_access.png)

完成以上步骤后, 专线客户端配置好路由即可与 VPC 私有网络主机互通。