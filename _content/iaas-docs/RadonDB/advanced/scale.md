---
---

# 扩容集群

可以对一个运行中的数据库服务进行在线扩容，调整 CPU/内存/磁盘空间大小。每次扩容只能选择一种角色。

![扩容集群](../_images/scale.png)



**注解**：扩容需要在开机状态下进行，扩容 SQL 节点时链接会有短暂中断，请在业务低峰时进行。