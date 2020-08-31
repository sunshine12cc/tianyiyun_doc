---
---

# RadonDB产品功能

**自动水平分表**

自动实现数据库水平分表，用户无需关心分表规则，只需指定分区键( shardkey )即可，系统将自动通过 Hash 算法进行数据库分片操作。

**支持分布式事务**

支持跨分区的分布式事务，完整实现事务的原子性 (Atomicity) 、一致性 (Consistency) 、隔离性 (Isolation) 及持久性 (Durability)，也即 ACID 特性。

**自动数据压缩**

当分区  MySQL 选择使用 TokuDB 存储引擎时, 将自动实现高比率数据压缩，存储空间利用率提升 50%，大幅节约存储空间及 IO 开销，进一步优化服务性能。

**智能平滑扩容**

支持在线实时弹性扩展，可以对分区数量和分区内存储容量横纵向伸缩；当扩容完成后，数据会自动在各分片间进行重新平衡 (Auto – Rebalance) ，且业务无感知，不会因扩容而中断。

**支持链接线程池**

提供链接线程池，预置一组链接线程资源，当分布式 SQL 集群需要与各存储节点建立访问链接时，可以通过这些预置线程实现链接的快速建立，并支持链接重用及自动重连，优化整体链接效率。

**审计日志**

用户可选择开启 SQL 查询审计日志功能，实现对查询的事件时间、操作语句类型及耗时等多个维度的审计，保障用户的运营安全，满足数据合规需求；审计日志可设置为：读操作审计、写操作审计、或读写操作同时审计模式，用户可以根据实际需求灵活选择。

**全链路实时监控**

提供对用户链接层、内部事务层、分区链接层三个层面的实时监控，帮助用户实时了解交易事务及查询语句等操作的执行情况，同时配合 QingCloud AppCenter 提供的多维度服务状态监控指标， 为用户提供全方位的运维监控数据，打破服务黑盒。

**安全防护**

RadonDB 在云模式下部署在专属网络 VPC 环境中，提供完全隔离的私有网络环境，同时提供防火墙并支持 IP 白名单，实现策略灵活的安全防护；配合 QingCloud 负载均衡器防火墙及 WAF，可有效防御 SQL 注入等网络攻击，实现多层安全保障。

**支持多种交付模式**

用户可通过 QingCloud AppCenter 以云应用形式在公有云或私有云平台上一键部署 RadonDB 集群，并可以根据对性能和运行环境的需求，灵活选择将集群运行于虚拟主机 (VM) 、容器主机 (CM) 、或物理主机 (BM) 之上；同时， RadonDB 也支持非云模式下的独立部署。