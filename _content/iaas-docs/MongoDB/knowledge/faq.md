---
---

# FAQ

## 如何查询连接数？

根据您购买的MongoDB实例规格不同，最大连接数也不同，通过 Mongo Shell 连接实例，执行命令`db.serverStatus().connections`

```
mgset-123456:PRIMARY> db.serverStatus().connections
{
        "current" : 1,
        "available" : 999,
        "internal_current" : 10,
        "internal_available" : 990,
        "totalCreated" : 632
}       
```

> **说明** 您需要关注以下参数及对应的值。
>
> * "current" ：当前已经建立的连接数。
> * "available" ：当前可用的连接数。

## 如何查询当前连接来源？

1. 通过 Mongo Shell 连接实例，切换至admin数据库。

   ```
   use admin
   ```

2. 执行命令 `db.runCommand({currentOp: 1, $all: true})`

   ```
mgset-123456:PRIMARY> db.runCommand({currentOp: 1, $all:[{"active" : true}]})                    
   ```

通过分析命令的输出结果，您可以查询每个连接对应的来源IP地址。从而得出各个终端跟MongoDB实例分别建立了多少连接。