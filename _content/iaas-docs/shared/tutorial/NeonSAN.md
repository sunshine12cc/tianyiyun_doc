---
---

# 企业级分布式 SAN (NeonSAN)

企业级分布式 SAN (NeonSAN) 是基于全闪存架构提供的分布式 SAN 服务，适用于对 IOPS、吞吐、容量和稳定性要求很高的业务，例如：企业核心数据库Oracle RAC及SQL Server 故障转移集群等、企业级分布式数据库RadonDB、物理主机高可用架构、大数据分析与计算、以及搭建高可用容器集群等。

## 创建

**第一步：创建加载企业级分布式 SAN (NeonSAN)**

点击 **共享存储** 进入如下界面

[![](../_images/create_NeonSAN_1.png)](../../_images/create_NeonSAN_1.png)

选择 **企业级分布式 SAN (NeonSAN)** 标签，点击创建，进入如下界面

[![](../_images/create_NeonSAN_2.png)](../../_images/create_NeonSAN_2.png)

在名称框里输入创建的硬盘名称，在数量框里输入需要创建的硬盘数量，在类型中选择超高性能容量型，拖动滑动按钮选择容量大小，或者在右边的输入框中输入容量大小，副本策略可选择2-3，点击 **提交** ，进入如下界面

[![](../_images/create_NeonSAN_3.png)](../../_images/create_NeonSAN_3.png)

当状态显示为“可用”时，表示创建成功。

> 注解：IO 吞吐 256 MB/s; 单块最小容量 100 GB、最大容量 50 TB，容量可选最小粒度为 100 GB

**第二步：配置服务**

鼠标右键点击硬盘条目，或选中硬盘条目鼠标左键点击更多操作，跳出如下界面

[![](../_images/create_NeonSAN_4.png)](../../_images/create_NeonSAN_4.png)

[![](../_images/create_NeonSAN_5.png)](../../_images/create_NeonSAN_5.png)

**加载企业级分布式 SAN (NeonSAN)到主机**

点击 **加载硬盘到主机** ，跳出如下界面

[![](../_images/create_NeonSAN_6.png)](../../_images/create_NeonSAN_.png)

选择需要加载该企业级分布式 SAN (NeonSAN) 的主机，点击 **提交**，即可挂载到指定主机。

> 注解：企业级分布式 SAN (NeonSAN)为共享型，可以同时挂载到多台主机

还可以从主机页面，鼠标右键点击主机条目，来选择 **硬盘**，进行硬盘加载，界面如下

[![](../_images/create_NeonSAN_7.png)](../../_images/create_NeonSAN_7.png)

**修改企业级分布式 SAN (NeonSAN) 名称或属性**

点击 **修改**，跳出如下界面

[![](../_images/create_NeonSAN_8.png)](../../_images/create_NeonSAN_8.png)

可以修改企业级分布式 SAN (NeonSAN) 的属性，包括名称和描述，然后点击 **修改** 。

**克隆企业级分布式 SAN (NeonSAN)**

点击 **克隆硬盘** ，跳出如下界面

[![](../_images/create_NeonSAN_9.png)](../../_images/create_NeonSAN_9.png)

在名称框填入名称，写入拷贝数量，类型选择企业级分布式 SAN (NeonSAN) ，点击 **提交** ，进入如下界面

[![](../_images/create_NeonSAN_10.png)](../../_images/create_NeonSAN_10.png)

当状态显示为“可用”时，表示克隆成功。

**扩容**

点击 **扩容** ，跳出如下界面

[![](../_images/create_NeonSAN_11.png)](../../_images/create_NeonSAN_11.png)

**备份**

点击 **备份** ，跳出如下界面

[![](../_images/create_NeonSAN_12.png)](../../_images/create_NeonSAN_12.png)

点击 **继续** ，进入如下界面

[![](../_images/create_NeonSAN_13.png)](../../_images/create_NeonSAN_13.png)

在名称框里填入名称，有需要的选择创建新备份链，点击 **提交** 。可以左键点击企业级分布式 SAN (NeonSAN) 条目，进入如下界面

[![](../_images/create_NeonSAN_14.png)](../../_images/create_NeonSAN_14.png)

可以看到状态显示为“可用”，表示备份已经创建成功。

**标签**

点击 **标签** ，为已经创建的企业级分布式 SAN (NeonSAN) 绑定标签，跳出如下界面

[![](../../../product/storage/_images/create_NeonSAN_5.png)](../../_images/create_NeonSAN_15.png)

如果没有标签或已有标签不适用，可以选择 **创建标签** ，或者进行 **标签管理** 。选择标签，点击 **提交** ，进入如下界面

[![](../_images/create_NeonSAN_16.png)](../../_images/create_NeonSAN_16.png)

**添加到资源组**

点击 **添加到资源组** ，选择需要添加到的资源组，点击 **提交** 。

## 备份配置

左键点击性能型硬盘条目，进入如下界面

[![](../_images/create_NeonSAN_17.png)](../../_images/create_NeonSAN_17.png)

鼠标右键点击备份链ID，跳出如下界面

[![](../_images/create_NeonSAN_18.png)](../../_images/create_NeonSAN_18.png)

**修改备份名称或描述**

点击 **修改** ，跳出如下界面

[![](../_images/create_NeonSAN_19.png)](../../_images/create_NeonSAN_19.png)

在名称填入要修改成的名称，在描述框里输入新的描述，点击 **提交** 。

**基于备份新建硬盘**

点击 **创建硬盘** ，跳出如下界面

[![](../_images/create_NeonSAN_20.png)](../../_images/create_超高性能容量型_20.png)

在名称框里填入新硬盘的名称，点解 **提交** ，可以硬盘首页看到

[![](../_images/create_NeonSAN_21.png)](../../_images/create_NeonSAN_21.png)

当新建硬盘的状态显示为“可用”时，表示新硬盘已经创建成功。

**共享备份**

点击 **共享备份** ，跳出如下界面

[![](../_images/create_NeonSAN_22.png)](../../_images/create_NeonSAN_22.png)

可以选择共享给子账号还是共享给其他账号，选择要共享给的子账号或填写要给共享的其他用户ID/注册邮箱地址，点击 **提交** 。鼠标右键双击备份链接入备份属性修改界面，可以看到共享列表，里面有已经添加成功的共享账号列表。

**跨区复制备份**

点击 **跨区复制备份** ，跳出如下界面

[![](../_images/create_NeonSAN_23.png)](../../_images/create_NeonSAN_23.png)

选择要复制到区域，点击 **提交** 。

## 备份属性修改

鼠标左键双击备份链条目，或者在备份链条目下面，可以看到备份链结构示意图，假如双击备份链条目，进入如下界面

[![](../_images/create_NeonSAN_24.png)](../../_images/create_NeonSAN_24.png)

鼠标左键点击备份链右侧的 **...** ，可以选择对备份链的修改、创建硬盘、回滚和删除，界面如下

[![](../_images/create_NeonSAN_25.png)](../../_images/create_NeonSAN_25.png)

## 监控

在企业级分布式 SAN (NeonSAN) 挂载到主机时，可以点击硬盘条目，查看监控情况，界面如下

[![](../_images/create_NeonSAN_26.png)](../../_images/create_NeonSAN_26.png)

在硬盘IOPS和硬盘吞吐量打开时，可以看到硬盘IOPS和硬盘吞吐量数据展示。还可以点击硬盘使用率右侧的 **查看监控图** 来查看硬盘使用率。