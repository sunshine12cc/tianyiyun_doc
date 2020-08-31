---
---

# Redis Cluster 多可用区（同城多活）测试
## 同城多活测试

### 背景

- [青云QingCloud 升级区域（Region）架构 轻松实现同城多活](https://log.qingcloud.com/archives/3981)

### 测试结果

redis 节点的同城多活测试可参考 [Redis standalone 同城多活测试](https://docs.qingcloud.com/product/database_cache/redis-standalone/index.html#多可用区同城多活测试)，针对于 redis cluster 的集群需要考虑到分片的影响，多区部署的网络和集群内部的 MOVED 重定向会影响到集群的平均 QPS，为了消除重定向对 QPS 的影响，建议选择可以缓存 slot 分布的客户端。