---
---

# 简介

## 描述 

`PostgreSQL on QingCloud AppCenter` 将 Postgresql 通过云应用的形式在 QingCloud AppCenter 部署，具有如下特性：

- 目前提供单节点版和主从双节点2个版本，分别满足开发测试和生产环境下的数据库需求。
- 主从双节点版本提供主从节点，主节点提供读写服务，从节点提供读服务。
- 主从双节点版本支持自动 failover 功能，提供 HA 功能。
- 提供 PostgreSQL 大部分常用参数修改接口，方便调整参数。
- 支持 PostGIS 插件，为 PostgreSQL 提供了存储、查询和修改空间关系的能力。
- 提供实时监控、健康检查、日志自动清理等功能，方便用户运维。
- 一键部署，开箱即用。

> 注意：PostgreSQL on QingCloud AppCenter  支持如下版本:  
> PostgreSQL 9.6.3版本，PostGIS 插件的版本是 PostGIS 2.3      
> PostgreSQL 10.1 版本，PostGIS 插件的版本是 PostGIS 2.4     

## 简介  

[PostgreSQL](https://www.postgresql.org/) 是一个功能强大的开源数据库系统。经过长达 15 年以上的积极开发和不断改进，PostgreSQL 已在可靠性、稳定性、数据一致性等获得了业内极高的声誉。作为一种企业级数据库，PostgreSQL 以它所具有的各种高级功能而自豪，像多版本并发控制 (MVCC)、按时间点恢复 (PITR)、表空间、异步复制、嵌套事务、在线热备、复杂查询的规划和优化以及为容错而进行的预写日志等。它支持国际字符集、多字节编码并支持使用当地语言进行排序、大小写处理和格式化等操作。它也在所能管理的大数据量和所允许的大用户量并发访问时间具有完全的高伸缩性。