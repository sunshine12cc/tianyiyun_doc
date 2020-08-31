---
---

# IP 池

IP 池管理功能下，用户可将本地环境物理交换机中配置的网段（VLAN 段地址）创建添加到记录中，用于分配具体 IP 地址的网段选择。在 IP 池中用户可以创建多个 IP 组，即自定义一个基础网络。在此功能下，除了可以查看当前每个网段（VLAN 段地址）的 IP 使用量以及相关属性信息外，还在详情页中支持查看使用该网段的关联虚拟机资源、网络监控和网卡流量监控。


## 创建 IP 组

1、选择「虚拟资源」→「网络」→「IP 池」，然后点击 「+ 创建 IP 组」。

![](https://pek3b.qingstor.com/kubesphere-docs/png/20190524174136.png)


2、在弹窗中填写 IP 组的基本信息，点击 「创建」。

> 注意，禁止添加一个交换机上没有预先配置 VLAN 的地址及对应的 VLAN ID，以防止虚拟机的运行产生异常。


> - 名称：为 IP 组起一个简洁明了的名称，便于用户浏览和搜索；
> - IP 网段：根据基础网络中划分的网段填写；例如以下示例填写 `172.31.46.1/24`；
> - VLAN：范围：0-4095，0 表示没有 vlan_id，4095 表示所有；
> - 描述：为该 IP 组添加描述信息。

![](https://pek3b.qingstor.com/kubesphere-docs/png/20190525000745.png)

3、IP 组创建成功，点击可进入 IP 组的详情页。

> 提示，IP 组创建后可将虚拟网卡或虚拟机加入至该 IP 组中。

![](https://pek3b.qingstor.com/kubesphere-docs/png/20190525000952.png)

## 将虚拟机加入 IP 组

### 将虚拟机加入 IP 组

1、若用户希望将一台虚拟机加入一个 IP 组，或将虚拟机从一个 IP 组迁移加入至另一个 IP 组 (虚拟机需先离开原有 IP 组)，则可在虚拟机列表执行如下步骤。如下在虚拟机列表页将 `ip-test` 虚拟机加入上一步创建的 IP 组中。

![](https://pek3b.qingstor.com/kubesphere-docs/png/20190525081053.png)

2、选择 ip_group 作为虚拟机的基础网络。

![](https://pek3b.qingstor.com/kubesphere-docs/png/20190525081333.png)

3、加入后将为虚拟机自动分配一个属于该 IP 组的网段中 IP。

![](https://pek3b.qingstor.com/kubesphere-docs/png/20190525083331.png)

### 创建虚拟机时加入 IP 组

在新建虚拟机时也可以加入 IP 组，如下所示新建一台虚拟机 `docs-demo`，在网络中选择 「选择基础网络」。创建虚拟机的步骤指引可参考 [虚拟机](vm.html)。

![](https://pek3b.qingstor.com/kubesphere-docs/png/20190525080044.png)

## 查看 IP 组

在 IP 组的详情页可查看关联资源、网络监控和网卡流量监控等资源的监控信息。

### 关联资源

包括在当前 IP 组中工作的实例信息，例如以下包括上一步加入该 IP 组的两台主机，支持下钻到主机进一步查看主机状态。

![](https://pek3b.qingstor.com/kubesphere-docs/png/20190525002047.png)

### 网络监控

网络监控包括以下指标，可选择的时间跨度：最近 6 小时、1 天、2 周、1 个月，并支持查看实时数据。

- 网络流量监控：可选入/出流量（单位：bps 间隔：5分钟）
- 包转发率监控：可选入/出流量（单位：pps 间隔：5分钟）

![](https://pek3b.qingstor.com/kubesphere-docs/png/20190525082817.png)

### 网卡流量监控

网卡流量监控提供当前 IP 组中所有网卡出/入流量与出/入包流量的数据，支持按流量大小排名。

![](https://pek3b.qingstor.com/kubesphere-docs/png/20190525082728.png)
