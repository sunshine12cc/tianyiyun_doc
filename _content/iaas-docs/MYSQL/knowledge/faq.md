---
---

# FAQ

## MySQL CPU 100%?

CPU 100% 通常是由有问题的查询造成的，包括全表扫描，排序，扫描大量数据，锁争用等。

可以连上 MySQL Server 执行 "show processlist" 找到有问题的查询并对其进行优化；

或者也可以下载慢查询日志，找到最耗时的查询并对其进行提前优化。

## 如何查看MySQL Binlog?

`mysqlbinlog –base64-output=decode-rows -v mysql-bin.000001`

## 创建MySQL或者PostgreSQL的时候选的磁盘空间,没有让选数据副本,是单副本吗?

1. 不是单副本的;
2. 每个节点的数据, 默认都会维护多个实时副本数据;
3. 这些副本保存在不同的硬件上，可以确保某台硬件出现故障时，数据可以通过实时副本来恢复;
4. MySQL 或者 PostgreSQL 本身提供主从高可用机制, 底层数据也是多个副本去保证数据安全的.