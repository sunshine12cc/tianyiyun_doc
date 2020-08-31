---
---

# MongoDB on QingCloud AppCenter 用户指南

## 简介

青云QingCloud MongoDB 服务提供的是原生 [MongoDB](https://www.mongodb.com/) replica set 云服务，MongoDB 是一个开源的文档型数据库，具有高性能、高可用等优点。


## 创建 MongoDB

在青云上，您可以很方便的创建和管理一个 MongoDB 集群。青云的 MongoDB 集群支持横向与纵向在线伸缩，同时具有自我诊断与自我修复功能，即当系统发现某节点坏死时会自我修复，无需人为干预。 另外我们还提供了监控告警等功能来帮助您更好的管理集群。集群将运行于私有网络内，结合青云提供的高性能硬盘，在保障高性能的同时兼顾您的数据安全。

> 为了保障数据安全，MongoDB 集群需要运行在受管私有网络中。所以在创建一个 MongoDB 集群之前，需要创建一个 VPC 和一个受管私有网络，受管私有网络需要加入 VPC，并开启 DHCP 服务（默认开启）。

第一步：创建集群

在创建的对话框中，您需要填写名称 (可选)，选择 MongoDB 版本号、CPU、节点配置和数量、私有网络等。

> 目前集群节点数支持1、3、5、7，其中1个节点的 MongoDB 仅供测试使用。

> 用户默认创建在admin数据库下，连接时需要指定认证数据库为admin。

![](_images/step1.png)

- 磁盘选择

_MongoDB 4.0.3 - QingCloud 1.2.0_ 添加了企业级分布式 SAN（NeonSAN），最高可支持 50000G 的磁盘扩展，可满足您大容量的数据存储需求，该功能目前仅在 `北京 3B` 、 `上海1A` 和 `广东 2 区` 支持。

![](_images/step1_1.png)

第二步：创建成功

当 MongoDB 创建完成之后，您可以查看每个节点的运行状态。当节点的服务状态显示为“正常”状态，表示该节点启动正常。 当每个节点都启动正常后 MongoDB 集群显示为“活跃”状态，表示您已经可以正常使用 MongoDB 服务了。

![](_images/step2.png)

## 测试 MongoDB

### 使用 mongo 客户端进行连接

MongoDB 创建完成之后可以进行连接测试。参考文档 https://docs.mongodb.com/manual/administration/install-on-linux/ 下载并安装 `mongodb-org-shell`，您可以在 MongoDB 同一私有网络或跨网络的客户端上测试。现假设客户端和 MongoDB 在同一私有网络，MongoDB 集群有三个节点，IP 地址分别为`192.168.0.23,192.168.0.24,192.168.0.27`， 您创建的用户名为`qc_test`，密码为`Pwd00000`，可以通过如下命令连接 MongoDB：

```shell
mongo mongodb://qc_test:Pwd00000@192.168.0.23,192.168.0.24,192.168.0.27/admin?replicaSet=foobar
```

连接成功后将出现下面的命令行：

```text
foobar:PRIMARY>
```

### 创建用户

> 创建集群时输入的用户名对应的是 readWriteAnyDatabase 权限的普通账号，无法创建用户。如果需要创建用户，请使用 root 账号，密码与你输入的密码相同。连接时请使用与集群版本相同或者偏上的版本。

下面演示如何在 `db1` 中，创建一个用户名`test_user1`，密码为`Pwd00001`，具有`readWrite`权限的用户。首先，使用 root 账号进行连接：

```shell
mongo mongodb://root:Pwd00001@192.168.0.23,192.168.0.24,192.168.0.27/admin?replicaSet=foobar
```

连接成功后执行如下的命令：

```javascript
use db1;
db.createUser({ user: "test_user1", pwd: "Pwd00001", roles: [ "readWrite" ]});
```

创建成功后可以`Ctrl+C`退回到 shell 中，使用如下命令以`test_user1`身份连接到`db1`。

```shell
mongo mongodb://test_user1:Pwd00001@192.168.0.23,192.168.0.24,192.168.0.27/db1?replicaSet=foobar
```

更多权限管理可以参考: https://docs.mongodb.com/manual/tutorial/enable-authentication/

### 使用代码进行连接

如果使用代码进行连接，那么 MongoDB 连接字符串为 mongodb://USER:PASSWORD@IP/DB?replicaSet=foobar&authSource=admin

其中:

- USER 是你所创建的用户名
- PASSWORD 是你设置的密码
- IP 是 replica set 中的节点 IP，使用逗号分隔，比如 192.168.0.23,192.168.0.24,192.168.0.27
- DB 是你需要进行连接的数据库
- replicaSet=foobar 是青云默认的 replicaSet 配置，值为 foobar
- authSource=admin 是指定验证数据库为 admin
- 更多参数可以参考: https://docs.mongodb.com/manual/reference/connection-string/


## 服务功能

点开基本属性旁边的下拉按钮，可以看到提供的服务功能。

![](_images/feature.png)

### 配置参数

这里列出了可以修改并持久化的配置参数。修改配置参数将会使集群重启，请在业务低峰时进行修改。

> _MongoDB 4.0.3 - QingCloud 1.2.0_ 之后的版本新增了 Caddy 服务替代老版本的 FTP 服务，配置参数中默认为您配置用户名为 caddy，密码为 caddy，您可以修改配置参数来配置您的用户名和密码，该相关配置不会导致 mongod 服务重启。

> _MongoDB 4.0.3 - QingCloud 1.3.0_ 新增了 zabbix-agent 服务，您可以将其加入您的 zabbix-server 方便统一管理，您可以通过修改配置参数来配置 zabbix-agent 的启停，该相关配置不会导致 mongod 服务重启。

![](_images/env.png)


### 连接 URL

_MongoDB 4.0.3 - QingCloud 1.2.0_ 版本新增了「连接 URL」一栏，您可以直接复制该 URL 并将其中的 [password] 修改为您的连接密码，[database] 修改为您需要连接的数据库即可。

> 在 shell 中通过该 URL 连接时需要在 `&` 前添加转义符 `\`

![](_images/connection_url.png)

### 节点详情

您可以在这里实时查看节点的状态

![](_images/nodes_role.png)

### 增删节点

可以根据需要增加集群节点，增加的节点数必须为偶数。添加节点的任务执行时间跟集群的数据量有关系，数据量大时，任务执行时间会久一些，添加节点不影响集群的读写。

删除节点不会导致主节点的 mongod 重启，但为避免影响到业务，请在业务量低时操作。

删除节点有如下限制：

- 数量必须为偶数，至少保留一个节点
- 无法删除主节点
- 无法删除 `qc_sid` 为 1 的节点

> `qc_sid` 可以使用 root 用户通过 mongo 连接之后执行 `rs.conf().members` 命令查看。`qc_sid` 为 1 的节点的选举优先级被我们设置为 2，所以这个节点通常是主节点。

![](_images/add_nodes.png)

### 备份

如果您打开了『自动备份』功能，那么 MongoDB 集群会在你指定的时间段进行每日的自动备份； 您可以从这些备份创建出全新的 MongoDB 集群；

如果您关闭了自动备份，可以在集群列表右键 MongoDB 集群后点击『创建备份』选项， 或者在集群详情页的『备份』标签下点击『创建备份』按钮。

> 如果备份后进行过增删节点，那么再次备份时需要创建新的备份链。

![](_images/create_snapshot.png)

如果需要从备份创建出一个独立于原有 MongoDB 集群的新 MongoDB 集群， 可以在集群详细页的『备份』标签下右键相应的备份点，再选择『从备份创建集群』即可。

![](_images/create_cluster_from_snapshot.png)

### 扩容集群

可以对一个运行中的集群进行在线扩容，调整CPU/内存/磁盘空间大小。

![](_images/scale1.png)

注解：扩容需要在开机状态下进行，扩容会导致重新选主，请在业务低峰时进行

#### 硬盘自动伸缩

Mongo 应用数据盘被占满会导致 mongod 服务进程挂掉

我们在 _MongoDB 4.0.3 QingCloud 1.4.0_ 版本中新增了「应用存储空间」自动伸缩的功能，您可以参照 [自动伸缩](https://docs.qingcloud.com/product/operation/autoscaling) 来实现您的自动伸缩自定义

### 同步日志

同步日志功能可以将 mongod.log 拷贝到系统的 FTP 目录，同步后可以在内网下载到本地进行分析。

> _MongoDB 4.0.3 - QingCloud 1.2.0_ 版本使用 Caddy 服务替代了老版本的 FTP 服务

![](_images/copy_log.png)

### 关闭同步日志

该栏为 _MongoDB 4.0.3 - QingCloud 1.2.0_ 版本新增服务，下载或查看完日志，您可以关闭 Caddy 服务

![](_images/stop_copy_log.png)

### 清理日志

清理日志功能可以将 mongod.log 清空，减少日志的磁盘空间占用。

![](_images/clean_log.png)

### zabbix-agent 服务

_MongoDB 4.0.3 - QingCloud 1.3.0_ 版本新增了 zabbix-agent 服务（3.4 版本），方便您采用 zabbix-server 统一管理各个集群的监控信息，zabbix-agent 服务的控制见 「配置参数」，启动服务后，用户只需要在 zabbix-server 的 web 界面添加主机即可，为了实现多维数据监控，我们提供了 [监控模板](https://releases-qs.pek3a.qingstor.com/zabbix/zbx_mongodb_templates.xml?response-content-disposition=attachment)（点击即可下载到本地）。用户只需要将该模板导入到 zabbix-server 即可使用。

> 「配置参数」中 「zabbix-server 地址」 填写的格式不正确，会导致 zabbix-agent 的不正确启停，该项的填写格式可参考 [配置文件](https://www.zabbix.com/documentation/3.4/manual/appendix/config/zabbix_agentd) 中的 「Server」 配置项。

![](./_images/zabbix_agent.png)



### 升级集群

`MongoDB v3.0.15 (MMAPv1)` 和 `MongoDB v3.4.5 (WiredTiger)` 版本均可以升级至 _MongoDB 4.0.3 - QingCloud 1.2.0_ 版本，升级前需要先关闭集群， `MongoDB v3.0.15 (MMAPv1)` 升级的时间较长，其时长主要受数据量的影响，数据量越大，升级所花费的时间越久。

> 升级前，请先对数据做好备份。

> `MongoDB v3.0.15 (MMAPv1)` 单节点不允许升级，如果您点了升级，不用担心，升级失败后您可以关闭集群然后选择「版本回退」即可。

> 由于 3.6 以上的版本不再支持对名字为 `*` 的索引的操作，所以您需要在升级前将名字为 `*` 的索引删除或者重命名，详情见 [Compatibility Changes in MongoDB 3.6](https://docs.mongodb.com/manual/release-notes/3.6-compatibility/#general-compatibility-changes) 

> 升级集群期间，客户端无法连接 mongo 服务，为了避免客户端的操作影响到升级的过程，在这期间禁掉了客户端对 mongo 服务的访问。 

![](./_images/upgrade_1.png)

![](./_images/upgrade.png)



### 监控告警

目前提供的监控项包括：

- CPU 使用率

- 内存利用率

- 磁盘使用量

- MongoDB 各项操作数量

- MongoDB 复制操作数量

- MongoDB 连接数

_MongoDB 4.0.3 QingCloud 1.4.0_ 版本新增了以下监控项

- WIREDTIGER 内存状态

- WIREDTIGER TRANSACTIONS 状态

- GLOBALLOCK 请求状态

- GLOBALLOCK 队列状态

- 流量进出状态 

目前提供的告警项包括：

- CPU 利用率

- 内存利用率

- 磁盘使用量

- MongoDB 连接数

- MongoDB 可用连接数

- wiredTiger 内存使用率

## 数据导出和导入

使用 `mongodb-org-tools` 中的工具 `mongodump`, `mongorestore` 可以很方便的执行 MongoDB 数据的导出和导入。

- 使用 `mongodump` 工具可以将 MongoDB 中的数据导出，使用说明可以参考官方文档 https://docs.mongodb.com/manual/reference/program/mongodump/
- 使用 `mongorestore` 工具可以将 `mongodump` 导出的数据导入到 MongoDB 中，使用说明可以参考官方文档 https://docs.mongodb.com/manual/reference/program/mongorestore/

### 在线导入

下面演示如何将`192.168.110.101`的数据直接在线导入到`192.168.110.102`中。在同一个VPC下创建一台主机，安装 `mongodb-org-tools` 工具。在命令行中执行以下的命令：

```shell
mongodump --archive --username=user001 --password=Pwd00001 --authenticationDatabase=admin --host=192.168.110.101 --db=db1 | mongorestore --archive --username=user002 --password=Pwd00002 --authenticationDatabase=admin --host=192.168.110.102 --db=db2
```

其中: 使用 `192.168.110.101`的用户`user001`，密码`Pwd00001`，验证数据库`admin`，导出数据库`db1`，导入到`192.168.110.102`的用户`user002`，密码`Pwd00002`，验证数据库`admin`，导入数据库`db2`

## 基准测试

我们用 [Yahoo! Cloud Serving Benchmark](https://github.com/brianfrankcooper/YCSB/tree/master/mongodb) 工具套件进行了基准测试，下面分别是各配置的测试结果。

> YCSB 不支持用户名密码登录，下面的结果是在关闭认证后测试得到的，仅供参考。由于安全原因，我们禁止您关闭 MongoDB 的认证，建议在实际性能评估时以模拟正式场景为准。

- 1核2G 100G 超高性能型硬盘

```shell
./bin/ycsb load mongodb-async -s -P workloads/workloada -p operationcount=1000000 -p recordcount=1000000 -threads 100 -p mongodb.url="mongodb://192.168.100.26/ycsb"
[OVERALL], RunTime(ms), 193602.0
[OVERALL], Throughput(ops/sec), 5165.2358963233855
./bin/ycsb run mongodb-async -s -P workloads/workloada -p operationcount=1000000 -p recordcount=1000000 -threads 100 -p mongodb.url="mongodb://192.168.100.26/ycsb"
[OVERALL], RunTime(ms), 254871.0
[OVERALL], Throughput(ops/sec), 3923.553483919316
```

- 2核4G 100G 超高性能型硬盘

```shell
./bin/ycsb load mongodb-async -s -P workloads/workloada -p operationcount=1000000 -p recordcount=1000000 -threads 100 -p mongodb.url="mongodb://192.168.100.26/ycsb"
[OVERALL], RunTime(ms), 73817.0
[OVERALL], Throughput(ops/sec), 13547.014915263422
./bin/ycsb run mongodb-async -s -P workloads/workloada -p operationcount=1000000 -p recordcount=1000000 -threads 100 -p mongodb.url="mongodb://192.168.100.26/ycsb"
[OVERALL], RunTime(ms), 122344.0
[OVERALL], Throughput(ops/sec), 8173.674230039887
```

- 4核8G 100G 超高性能型硬盘

```shell
./bin/ycsb load mongodb-async -s -P workloads/workloada -p operationcount=1000000 -p recordcount=1000000 -threads 100 -p mongodb.url="mongodb://192.168.100.26/ycsb"
[OVERALL], RunTime(ms), 40768.0
[OVERALL], Throughput(ops/sec), 24529.042386185243
./bin/ycsb run mongodb-async -s -P workloads/workloada -p operationcount=1000000 -p recordcount=1000000 -threads 100 -p mongodb.url="mongodb://192.168.100.26/ycsb"
[OVERALL], RunTime(ms), 47416.0
[OVERALL], Throughput(ops/sec), 21089.92745064957
```

> 下面同时运行了两个 YCSB 实例来对 8核16G 和 16核32G 进行基准测试， 需要注意的是两个 YCSB 实例实际上也并不能压满 MongoDB 的性能，所以 OPS 仅供参考之用。

- 8核16G 100G 超高性能型硬盘

```shell
./bin/ycsb load mongodb-async -s -P workloads/workloada -p operationcount=1000000 -p recordcount=1000000 -threads 100 -p mongodb.url="mongodb://192.168.100.26/ycsb"
[OVERALL], RunTime(ms), 35088.0
[OVERALL], Throughput(ops/sec), 28499.772001823985
```

```shell
./bin/ycsb run mongodb-async -s -P workloads/workloada -p operationcount=1000000 -p recordcount=1000000 -threads 100 -p mongodb.url="mongodb://192.168.100.26/ycsb"
[OVERALL], RunTime(ms), 50013.0
[OVERALL], Throughput(ops/sec), 19994.80135164857
```

```shell
./bin/ycsb run mongodb-async -s -P workloads/workloada -p operationcount=1000000 -p recordcount=1000000 -threads 100 -p mongodb.url="mongodb://192.168.100.26/ycsb"
[OVERALL], RunTime(ms), 51555.0
[OVERALL], Throughput(ops/sec), 19396.76074095626
```

- 16核32G 100G 超高性能型硬盘

```shell
./bin/ycsb load mongodb-async -s -P workloads/workloada -p operationcount=1000000 -p recordcount=1000000 -threads 100 -p mongodb.url="mongodb://192.168.100.26/ycsb"
[OVERALL], RunTime(ms), 33882.0
[OVERALL], Throughput(ops/sec), 29514.196328433976
```

```shell
./bin/ycsb run mongodb-async -s -P workloads/workloada -p operationcount=1000000 -p recordcount=1000000 -threads 100 -p mongodb.url="mongodb://192.168.100.26/ycsb"
[OVERALL], RunTime(ms), 37720.0
[OVERALL], Throughput(ops/sec), 26511.134676564157
```

```shell
./bin/ycsb run mongodb-async -s -P workloads/workloada -p operationcount=1000000 -p recordcount=1000000 -threads 100 -p mongodb.url="mongodb://192.168.100.26/ycsb"
[OVERALL], RunTime(ms), 38600.0
[OVERALL], Throughput(ops/sec), 25906.73575129534
```

## 其他

- 如果您需要保持数据的强一致性，可以在客户端通过修改配置项来实现，配置方式可参考 [官方文档](https://docs.mongodb.com/manual/core/replica-set-write-concern/)

- 在使用 mongodb 的过程中建议您使用长连接，您可以通过「连接数」监控项来判断您的可用连接数，在可用连接数不大于 3 的时候，建议您检查下您的客户端是否需要这么多的连接，并合理释放连接数，您也可以根据需要通过修改配置参数来放大您的可用连接数。

![](./_images/add_connections.png)

## MongoDB Paas 文档

MongoDB Paas 文档请点击[这里](../mongo.html)