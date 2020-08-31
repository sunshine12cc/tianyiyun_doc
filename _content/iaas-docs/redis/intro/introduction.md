---
---

# 产品介绍
在 QingCloud 上，您可以方便地创建和管理一个 Redis 缓存集群。QingCloud 缓存集群包含多个缓存节点，Redis 支持一主多从、多主多从架构。

## Redis standalone

   [Redis](https://redis.io/) 是一个使用ANSI C编写的开源、支持网络、基于内存、可选持久性的键值对存储数据库。

**Redis standalone on QingCloud** 将 **Redis** 封装成 App，采用 **Redis** 最近的稳定版本 3.2.9 构建，支持在 AppCenter 上一键部署，在原生 **Redis** 的基础上增加了其易用性、高可用的特性，免去您维护的烦恼。细致说来，具有如下特性：

- 高可用性。

  **Redis standalone on QingCloud** 集成 **[Redis Sentinel](https://redis.io/topics/sentinel)** 机制，支持秒级主从切换，并提供一个对外的读写 vip，在保证高可用性的同时，无需手动切换主节点 IP 地址。

- 支持节点的纵向和横向扩容。

  **Redis standalone on QingCloud** 支持单节点和三节点部署方式，只有多节点部署形式包含主从自动切换的功能。可以从单节点增加节点到多节点，而无需暂停当前 **Redis** 服务。也可以从多节点缩小到单节点，此时会导致服务的短暂不可用。

  **目前，各个版本支持的节点伸缩数：**

    1、Redis 5.0.3 - QingCloud 1.2.2 版本支持单节点、双节点和三节点的节点伸缩

    2、其他版本支持单节点和三节点的节点伸缩。

- 一键部署。 

  无需额外配置，可以立即部署一个 **Redis** 服务

- 同城多活

  `Redis 5.0.3 - QingCloud 1.2.2` 和 `Redis 5.0.5 - QingCloud 2.0.0` 版本支持同城多活，在 `北京3区` 和 `广东2区` 部署 app 的用户可以选择同城多活，来实现业务容灾

## Redis Cluster

Redis 是一个使用ANSI C编写的开源、支持网络、基于内存、可选持久性的键值对存储数据库。

Redis cluster on QingCloud AppCenter 基于原生的 Redis 提供了 Redis cluster 的 App，能够在 AppCenter 进行一键部署，有如下特性：

- 支持一主多从以及多主多从，每个主所在分片 (shard) 平均分摊 16384 个 slots， 增加或删除主节点系统会自动平衡 slots 
- 集群支持 HA，即当某个主节点异常，它的从节点会自动切换成主节点
- 支持集群的横向及纵向伸缩
- 一键部署
- 基于最新的 Redis 4.0.6 稳定版构建
- Redis 5.0.3 - QingCloud 1.2.1 添加了同城多活，实现业务容灾
- Redis 5.0.5 - QingCloud 1.3.0 添加了内存限制，防止删除节点时出现 OOM
- Redis 5.0.5 - QingCloud 2.0.0 添加了 Caddy 服务，支持通过浏览器自助查看和下载 Redis 文件