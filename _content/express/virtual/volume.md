---
---

# 硬盘

CloudCube Express 的存储服务后端采用青云自主研发的新一代软件定义存储技术 [QingStor NeonSAN](https://www.qingcloud.com/products/qingstor-neonsan/)，QingStor NeonSAN 是基于全闪存架构提供的分布式 SAN 服务，可满足 IOPS、吞吐、容量和稳定性要求很高的业务。在 CloudCube Express 中，硬盘（Volume）为主机提供块存储设备，它独立于主机的生命周期而存在，可以被连接到任意运行中的主机上。

## 创建硬盘

登录 CloudCube Express 后，点击「虚拟资源」选择「硬盘」，进入硬盘列表页。

![](https://pek3b.qingstor.com/kubesphere-docs/png/20190525123944.png)

点击 「创建硬盘」，在弹窗中填写硬盘的基本信息。

- 名称：为硬盘起一个简洁明了的名称，便于用户浏览和搜索。
- 数量：需要创建的硬盘数量，最大不超过 20。
- 容量：单块硬盘的容量应在 10 GB ~ 100 TB 范围。
- 副本数：一般使用多副本技术来提高存储的高可靠性。

如下创建 2 个 100 GB、 2 副本的硬盘 `test-vol`，点击 「创建」。

![](https://pek3b.qingstor.com/kubesphere-docs/png/20190525124619.png)


## 挂载硬盘至虚拟机

挂载硬盘至虚拟机之前，请确保您已经创建了虚拟机。

1、在其中一个 `test-vol` 右侧点击 **···**，然后选择 「加载硬盘到主机」。

![](https://pek3b.qingstor.com/kubesphere-docs/png/20190525124703.png)

2、在弹窗中选择目标虚拟机 docs-demo，点击确定。

![](https://pek3b.qingstor.com/kubesphere-docs/png/20190525124954.png)

3、可以看到 test-vol 状态显示 `使用中`，说明已经加载成功。

![](https://pek3b.qingstor.com/kubesphere-docs/png/20190525125054.png)


## 查看监控

点击 test-vol，进入硬盘详情页查看监控状况。支持选择不同的时间跨度来监控主机磁盘的实时读/写情况，提供以下三个监控指标：

- 硬盘使用率
- IOPS 监控 (读/写)
- 吞吐量监控 (读/写)

![](https://pek3b.qingstor.com/kubesphere-docs/png/20190411173034.png)

## 创建备份

切换到 「备份」 页面，点击 「新建全量备份链」，在弹窗中填写名称即可创建主机备份。创建后支持修改、创建硬盘和删除备份。

![](https://pek3b.qingstor.com/kubesphere-docs/png/20190411173340.png)

> 提示：创建备份后，可使用备份中心集中管理备份，监控全平台的备份活动，或从备份还原平台资源，并且能够直观监控备份空间使用情况，每个备份链包括一个全量备份点以及多个增量备份点，您可以随时从任意一个备份点恢复数据，详见 [备份](../backup)。

> 注意：为了保证备份创建成功，正在创建备份时，您不能修改实例状态，比如写入数据，停止或重启实例。

填写备份的名称，点击 「创建」。

![](https://pek3b.qingstor.com/kubesphere-docs/png/20190411173410.png)

备份创建后，用户还可以基于该备份节点上创建全量或增量备份。

- 全量备份：备份整个数据集的完整副本。虽然可以说全量备份提供了最好的数据保护，但是一些机构仅仅定期使用它，因为做一次全备份是非常耗时的，而且往往需要大量的磁带或者磁盘。 
- 增量备份：增量备份只备份上次备份之后更改的数据，时间和磁盘消耗较小。 

![](https://pek3b.qingstor.com/kubesphere-docs/png/20190525125302.png)

## 查看操作日志

操作日志提供硬盘的操作历史记录包括操作事项、时间、对象资源、操作任务状态以及执行时长，可以根据资源的 ID 进行搜索相关的操作事项。如下查看到的操作日志包括上述步骤中创建硬盘、加载硬盘和创建备份的历史记录。

![](https://pek3b.qingstor.com/kubesphere-docs/png/20190525125352.png)

## 扩容硬盘

当硬盘处于未挂载 (可用) 状态时，即可将硬盘扩容。注意，硬盘只支持扩容，不支持缩减容量。

![](https://pek3b.qingstor.com/kubesphere-docs/png/20190525125551.png)

## 卸载硬盘

若需要将硬盘从主机卸载，点击「卸载硬盘」。

![](https://pek3b.qingstor.com/kubesphere-docs/png/20190411202656.png)

## 删除硬盘

若不需要使用该硬盘，可点击 「删除」，删除后资源将在回收站保留 3 天，请提前备份数据。

![](https://pek3b.qingstor.com/kubesphere-docs/png/20190411202848.png)

## 其他操作

此外，CloudCube Express 支持用户给硬盘添加标签和修改名称。