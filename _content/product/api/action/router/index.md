---
---

# 路由器[¶](#api-router "永久链接至标题")

通过青云的SDN（软件定义网络）技术，您可以快速地搭建您专属的私有云环境。 相比于基础网络而言，这个网络可以提供100%的安全隔离，而且有丰富的工具帮助您进行自动化管理。 要使用青云网络，请创建一个路由器，然后再创建一个或多个私有网络 ( 私有网络相关 API 可参见 [_私有网络_](../vxnet/index.html#api-vxnet) ) 并连接到这个路由器， 最后创建主机并加入到这些私有网络即可。

青云路由器用于 **受管私有网络** 之间互联，并提供三项附加服务： DHCP 服务、端口转发、VPN 隧道服务。如果您还希望路由器能接入互联网， 请捆绑一个公网 IP 给该路由器即可。

*   [DescribeRouters](describe_routers.html)
*   [CreateRouters](create_routers.html)
*   [DeleteRouters](delete_routers.html)
*   [UpdateRouters](update_routers.html)
*   [PowerOffRouters](poweroff_routers.html)
*   [PowerOnRouters](poweron_routers.html)
*   [JoinRouter](join_router.html)
*   [LeaveRouter](leave_router.html)
*   [ModifyRouterAttributes](modify_router_attributes.html)
*   [DescribeRouterStatics](describe_router_statics.html)
*   [AddRouterStatics](add_router_statics.html)
*   [ModifyRouterStaticAttributes](modify_router_static_attributes.html)
*   [DeleteRouterStatics](delete_router_statics.html)
*   [CopyRouterStatics](copy_router_statics.html)
*   [DescribeRouterVxnets](describe_router_vxnets.html)
*   [AddRouterStaticEntries](add_router_static_entries.html)
*   [DeleteRouterStaticEntries](delete_router_static_entries.html)
*   [ModifyRouterStaticEntryAttributes](modify_router_static_entry_attributes.html)
*   [DescribeRouterStaticEntries](describe_router_static_entries.html)
