---
---

# Sqoop 指南

Sqoop 是一个将数据在关系数据库（如 MySQL/Oracle 等）和大数据产品（如 Hadoop/Hive/HBase等）之间导入/导出的有效工具。本文介绍了如何使用青云 Sqoop 服务将数据在 MySQL 和 Hadoop/Hive/HBase 间导入/导出的常用场景和具体方法。其它关系数据库如 Oracle/SQL Server 在 Sqoop 中的使用方式与 MySQL 类似，关于 Sqoop 使用的所有详细信息，可参阅 [Sqoop 官方网站](https://sqoop.apache.org/docs/1.4.6/SqoopUserGuide.html) 。

## 创建 Sqoop 主机

要使用Sqoop 服务，首先您需要在映像市场中使用 BigData Client 映像创建一台主机，并将该主机加入和大数据集群（如 Hadoop/Hive/HBase等)相同的私有网络。创建成功后的主机已安装好 JDK/MySQL/Hadoop/Hive/HBase/Sqoop 等软件及客户端以供使用。另外，青云的主机支持纵向在线伸缩，还提供了监控告警等功能，使得 Sqoop 服务的使用和管理更加方便。

## 配置 Sqoop 服务

1.  如果要将数据在 MySQL 和 Hadoop 间导入/导出，请先参考 [Hadoop 指南——创建 Hadoop Client主机](https://docs.qingcloud.com/product/big_data/hadoop.html#id4) 配置 Hadoop 客户端
2.  如果要将数据在 MySQL 和数据仓库 Hive 间导入/导出，请先参考 [Hive 指南——创建 Hive 主机](https://docs.qingcloud.com/product/big_data/hive.html#id3) 配置 Hive 客户端
3.  如果要将数据在 MySQL 和列式数据库 HBase 间导入/导出，请先参考 [HBase 指南——创建 HBase Client 主机](https://docs.qingcloud.com/product/big_data/hbase#id4) 配置 HBase 客户端

## 测试 Sqoop 服务

**测试场景准备 0： 在新创建的 Sqoop 主机中启动 MySQL 服务**

>注解
如果您的 MySQL 在远端，请保证大数据集群中的主机可以远程访问到 MySQL，例如，执行 grant all privileges on _._ to ‘your_user’@’%’ identified by ‘your_password’ with grant option; flush privileges; 来使得 your_user/your_password 可以远程访问 MySQL 服务。

```
# 切换到 ubuntu 用户
su ubuntu

# 启动 MySQL 服务
service mysql.server start
Starting MySQL
. *

# 检测 MySQL 服务状态
service mysql.server status
 * MySQL running (1298)
```

**测试场景 1：将数据从关系数据库 MySQL 全量导入到 HDFS 中**

```
# 创建数据表 my_blog 并插入测试数据
mysql> create table my_blog(id int not null primary key auto_increment, title varchar(64) not null, mtime timestamp, comment varchar(255));
mysql> insert into my_blog values(null, 'first one', now(),  'hello world');
mysql> insert into my_blog values(null, 'second one', now(),  'my future');
mysql> insert into my_blog values(null, 'third one', now(),  'my story');
mysql> select * from my_blog;
        +----+------------+---------------------+-------------+
        | id | title      | mtime               | comment     |
        +----+------------+---------------------+-------------+
        |  1 | first one  | 2016-10-11 11:58:43 | hello world |
        |  2 | second one | 2016-10-11 11:59:21 | my future   |
        |  3 | third one  | 2016-10-11 11:59:40 | my story    |
        +----+------------+---------------------+-------------+

# 将 my_blog 表中的数据导入到 HDFS 分布式文件系统中，其中 username 和 password 是连接 MySQL 的测试用户名和密码，实际使用中请自行更改
sqoop-import --connect jdbc:mysql://192.168.120.8/test --username root --password p12cHANgepwD --table my_blog

# 查看导入成功后的文件数据
hadoop fs -cat my_blog/*
        1,first one,2016-10-11 11:58:43.0,hello world
        2,second one,2016-10-11 11:59:21.0,my future
        3,third one,2016-10-11 11:59:40.0,my story
```

**测试场景 2：将数据从关系数据库 MySQL 增量导入到 HDFS 中**

这个测试分为 append 追加模式和 lastmodified 更新模式，append 模式用在数据只是增加但没有更新的场景， lastmodified 模式用在数据不但有增加且有更新的情况。其中，append 模式会对相应字段大于 last-value 指定的值之后的记录进行追加导入，lastmodified 模式追加的是相应字段在 last-value 指定的日期之后被更新的记录。

2.1 使用 append 模式的方法如下:

```
# 模拟往 my_blog 表中新增数据行
insert into my_blog values(null, 'forth one', now(),  'another story');
mysql> select * from my_blog;
        +----+------------+---------------------+---------------+
        | id | title      | mtime               | comment       |
        +----+------------+---------------------+---------------+
        |  1 | first one  | 2016-10-11 11:58:43 | hello world   |
        |  2 | second one | 2016-10-11 11:59:21 | my future     |
        |  3 | third one  | 2016-10-11 11:59:40 | my story      |
        |  4 | forth one  | 2016-10-11 12:15:08 | another story |
        +----+------------+---------------------+---------------+

# 将 my_blog 表中 id 字段值大于 3 的新增行追加到 HDFS 文件中
sqoop-import --connect jdbc:mysql://192.168.120.8/test --username root --password p12cHANgepwD --table my_blog --check-column id --incremental append --last-value 3

# 查看导入成功后的文件数据
hadoop fs -cat my_blog/*
        1,first one,2016-10-11 11:58:43.0,hello world
        2,second one,2016-10-11 11:59:21.0,my future
        3,third one,2016-10-11 11:59:40.0,my story
        4,forth one,2016-10-11 12:15:08.0,another story
```

如果不想每次执行增量导入时都手动去查寻 last-value 的值，那可以使用 sqoop job 的方式执行增量导入，此时 sqoop 会自动保存上次导入成功后的 last-value 值，使用方式如下：

```
# 创建一个导入数据的 job 并保存
sqoop job -create myjob2 -- import  --connect jdbc:mysql://192.168.120.8/test --username root --password p12cHANgepwD --table my_blog -check-column id --incremental append --last-value 4

# 模拟新增数据
mysql> insert into my_blog values(null, 'fifth one', now(),  'aha moment');

# 执行以上保存的 job 就会开始导入数据
sqoop job --exec myjob2

# 查看结果
hadoop fs -cat my_blog/*
        1,first one,2016-10-11 11:58:43.0,hello world
        2,second one,2016-10-11 11:59:21.0,my future
        3,third one,2016-10-11 11:59:40.0,my story
        4,forth one,2016-10-11 12:15:08.0,another story
        5,fifth one,2016-10-11 12:58:48.0,aha moment

# 模拟再新增加数据
mysql> insert into my_blog values(null, 'sixth one', now(),  'have a rest');

# 重复执行以上保存的 job 即可将新增数据导入
sqoop job --exec myjob2

# 查看导入后的结果
hadoop fs -cat my_blog/*
        1,first one,2016-10-11 11:58:43.0,hello world
        2,second one,2016-10-11 11:59:21.0,my future
        3,third one,2016-10-11 11:59:40.0,my story
        4,forth one,2016-10-11 12:15:08.0,another story
        5,fifth one,2016-10-11 12:58:48.0,aha moment
        6,sixth one,2016-10-11 13:34:12.0,have a rest
```

2.2 使用 lastmodified 模式的方法如下:

```
# 查询出数据行的最近更新时间，作为接下来的数据导入命令的 last-value 参数的值
mysql> select max(mtime) from my_blog;
        +---------------------+
        | max(mtime)          |
        +---------------------+
        | 2016-10-11 13:34:12 |
        +---------------------+

# 创建一个导入数据的 job 并保存，其中 merge-key 是新老数据在做合并时需要参考使用的表字段，last-value 表示自从上次导入后 check-column 这列的最大值, target-dir 表示 HDFS 中将要接收导入数据的文件夹
sqoop job -create myjob3 -- import  --connect jdbc:mysql://192.168.120.8/test --username root --password p12cHANgepwD --table my_blog --incremental lastmodified --merge-key id --check-column mtime --last-value '2016-10-11 13:34:12' --target-dir my_blog

# 模拟更新老数据
mysql> update my_blog set mtime=now(),comment='my brand new future' where id=2;

# 模拟新增数据
mysql> insert into my_blog values(null, 'seventh one', now(),  'exciting start');
mysql> select * from my_blog;
        +----+-------------+---------------------+---------------------+
        | id | title       | mtime               | comment             |
        +----+-------------+---------------------+---------------------+
        |  1 | first one   | 2016-10-11 11:58:43 | hello world         |
        |  2 | second one  | 2016-10-11 14:30:25 | my brand new future |
        |  3 | third one   | 2016-10-11 11:59:40 | my story            |
        |  4 | forth one   | 2016-10-11 12:15:08 | another story       |
        |  5 | fifth one   | 2016-10-11 12:58:48 | aha moment          |
        |  6 | sixth one   | 2016-10-11 13:34:12 | have a rest         |
        |  7 | seventh one | 2016-10-11 14:31:12 | exciting start      |
        +----+-------------+---------------------+---------------------+

# 执行保存的 job 即可导入增量的数据
sqoop job --exec myjob3

# 查看更新和增加的新数据
hadoop fs -cat my_blog/*
        1,first one,2016-10-11 11:58:43.0,hello world
        2,second one,2016-10-11 14:30:25.0,my brand new future
        3,third one,2016-10-11 11:59:40.0,my story
        4,forth one,2016-10-11 12:15:08.0,another story
        5,fifth one,2016-10-11 12:58:48.0,aha moment
        6,sixth one,2016-10-11 13:34:12.0,have a rest
        7,seventh one,2016-10-11 14:31:12.0,exciting start
```

**测试场景 3：将数据从 HDFS 导出到 MySQL中**

```
# 在 MySQL 中创建一个表用来存放从 HDFS 中导出的数据
mysql> create table my_blog_back(id int not null primary key auto_increment, title varchar(64) not null, mtime timestamp, comment varchar(255));

# 将 HDFS 中 export-dir 指定文件夹的数据导出到 MySQL 的 my_blog_back 表中
sqoop export  --connect jdbc:mysql://192.168.120.8/test --username root --password p12cHANgepwD --table my_blog_back -export-dir /user/root/my_blog

# 查看成功导出的数据
mysql> select * from my_blog_back;
        +----+-------------+---------------------+---------------------+
        | id | title       | mtime               | comment             |
        +----+-------------+---------------------+---------------------+
        |  1 | first one   | 2016-10-11 11:58:43 | hello world         |
        |  2 | second one  | 2016-10-11 14:30:25 | my brand new future |
        |  3 | third one   | 2016-10-11 11:59:40 | my story            |
        |  4 | forth one   | 2016-10-11 12:15:08 | another story       |
        |  5 | fifth one   | 2016-10-11 12:58:48 | aha moment          |
        |  6 | sixth one   | 2016-10-11 13:34:12 | have a rest         |
        |  7 | seventh one | 2016-10-11 14:31:12 | exciting start      |
        +----+-------------+---------------------+---------------------+
```

**测试场景 4：当 Hive 中的表为 internal 类型时，将数据从 MySQL 全量导入到 Hive 中**

```
# 模拟创建 Hive 表存放的数据库
hive> create database test;

# 如果 HDFS 中的存在 my_blog 目录，需要删除，因为 Hive 导入时会使用
hadoop fs -rm -r -skipTrash my_blog

# 执行数据的导入，其中 hive-dabase 是 Hive 表 my_blog 所在的数据库
sqoop import --connect jdbc:mysql://192.168.120.8/test --username root --password p12cHANgepwD --table my_blog --hive-database test -hive-import -hive-table my_blog

# 查看成功导入后的数据
hive> select * from my_blog;
        OK
        1     first one       2016-10-11 11:58:43.0   hello world
        2     second one      2016-10-11 14:30:25.0   my brand new future
        3     third one       2016-10-11 11:59:40.0   my story
        4     forth one       2016-10-11 12:15:08.0   another story
        5     fifth one       2016-10-11 12:58:48.0   aha moment
        6     sixth one       2016-10-11 13:34:12.0   have a rest
        7     seventh one     2016-10-11 14:31:12.0   exciting start
```

**测试场景 5：当 Hive 中的表为 internal 类型时，将数据从 MySQL 增量导入到 Hive 中**

```
# 查询出数据行的最近更新时间，作为接下来的数据导入命令的 last-value 参数的值
mysql> select max(mtime) from my_blog;
        +---------------------+
        | max(mtime)          |
        +---------------------+
        | 2016-10-11 14:31:12 |
        +---------------------+

# 创建导入数据的 job 并保存，其中 target-dir 表示 Hive 表数据在 HDFS 中的存储位置，fields-terminated-by 表示 Hive 表中的每个字段是以什么符号作为结束
sqoop job --create myjob15 -- import --connect jdbc:mysql://192.168.120.8/test --username root --password p12cHANgepwD --table my_blog --hive-database test  -hive-table my_blog --incremental lastmodified --merge-key id --check-column mtime --last-value '2016-10-11 14:31:12' --target-dir /user/hive/warehouse/test.db/my_blog --fields-terminated-by '\001'

# 模拟更新老数据和增加新数据
mysql> update my_blog set mtime=now(),comment='share the same change' where id=3 or id=4;
mysql> insert into my_blog values(null, 'eighth one', now(),  'higher value change');
mysql> select * from my_blog;
        +----+-------------+---------------------+-----------------------+
        | id | title       | mtime               | comment               |
        +----+-------------+---------------------+-----------------------+
        |  1 | first one   | 2016-10-11 11:58:43 | hello world           |
        |  2 | second one  | 2016-10-11 14:30:25 | my brand new future   |
        |  3 | third one   | 2016-10-11 16:37:48 | share the same change |
        |  4 | forth one   | 2016-10-11 16:37:48 | share the same change |
        |  5 | fifth one   | 2016-10-11 12:58:48 | aha moment            |
        |  6 | sixth one   | 2016-10-11 13:34:12 | have a rest           |
        |  7 | seventh one | 2016-10-11 14:31:12 | exciting start        |
        |  8 | eighth one  | 2016-10-11 16:38:23 | higher value change   |
        +----+-------------+---------------------+-----------------------+

# 执行以上保存的 job
sqoop job --exec myjob15

# 在 Hive 中查看导入的结果
hive> select * from my_blog;
        OK
        1     first one       2016-10-11 11:58:43.0   hello world
        2     second one      2016-10-11 14:30:25.0   my brand new future
        3     third one       2016-10-11 16:37:48.0   share the same change
        4     forth one       2016-10-11 16:37:48.0   share the same change
        5     fifth one       2016-10-11 12:58:48.0   aha moment
        6     sixth one       2016-10-11 13:34:12.0   have a rest
        7     seventh one     2016-10-11 14:31:12.0   exciting start
        8     eighth one      2016-10-11 16:38:23.0   higher value change
```

**测试场景 6：当 Hive 中的表为 external 类型时，将数据从 MySQL 全量导入到 Hive 中**

```
# 模拟在 Hive 中创建一个外部表
hive> create external table my_exblog (
    > id string,
    > title string,
    > mtime string,
    > comment string
    > )
    > ROW FORMAT DELIMITED
    > FIELDS TERMINATED BY ','
    > LOCATION '/user/hive/warehouse/test.db/my_exblog';

# 创建并保存一个导入数据的 job， 其中各项参数的含义可参照之前测试场景中的命令
sqoop job --create myjob16 -- import --connect jdbc:mysql://192.168.120.8/test --username root --password p12cHANgepwD --table my_blog  --incremental lastmodified --merge-key id --check-column mtime --last-value '0' --target-dir /user/hive/warehouse/test.db/my_exblog

# 执行之上保存的 job
sqoop job --exec myjob16

# 查看导入后的数据
hive> select * from my_exblog;
        OK
        1     first one       2016-10-11 17:09:51.0   share the newer change
        2     second one      2016-10-11 14:30:25.0   my brand new future
        3     third one       2016-10-11 16:37:48.0   share the same change
        4     forth one       2016-10-11 16:37:48.0   share the same change
        5     fifth one       2016-10-11 17:09:51.0   share the newer change
        6     sixth one       2016-10-11 13:34:12.0   have a rest
        7     seventh one     2016-10-11 14:31:12.0   exciting start
        8     eighth one      2016-10-11 16:38:23.0   higher value change
        9     nineth one      2016-10-11 17:24:37.0   vip treatment
```

**测试场景 7：当 Hive 中的表为 external 类型时，将数据从 MySQL 增量导入到 Hive 中**

```
# 模拟更新老数据和插入新数据
mysql> update my_blog set mtime=now(),comment='external changes' where id=4 or id=9;
mysql> insert into my_blog values(null, 'tenth one', now(),  'external one');
mysql> insert into my_blog values(null, 'tenth one', now(),  'external two');
mysql> select * from my_blog;
        +----+-------------+---------------------+------------------------+
        | id | title       | mtime               | comment                |
        +----+-------------+---------------------+------------------------+
        |  1 | first one   | 2016-10-11 17:09:51 | share the newer change |
        |  2 | second one  | 2016-10-11 14:30:25 | my brand new future    |
        |  3 | third one   | 2016-10-11 16:37:48 | share the same change  |
        |  4 | forth one   | 2016-10-12 12:06:18 | external changes       |
        |  5 | fifth one   | 2016-10-11 17:09:51 | share the newer change |
        |  6 | sixth one   | 2016-10-11 13:34:12 | have a rest            |
        |  7 | seventh one | 2016-10-11 14:31:12 | exciting start         |
        |  8 | eighth one  | 2016-10-11 16:38:23 | higher value change    |
        |  9 | nineth one  | 2016-10-12 12:06:18 | external changes       |
        | 10 | tenth one   | 2016-10-12 12:06:41 | external one           |
        | 11 | tenth one   | 2016-10-12 12:06:45 | external two           |
        +----+-------------+---------------------+------------------------+

# 执行保存过的 job
sqoop job --exec myjob16

# 查看增量导入后的数据
hive> select * from my_exblog;
        OK
        1     first one       2016-10-11 17:09:51.0   share the newer change
        10    tenth one       2016-10-12 12:06:41.0   external one
        11    tenth one       2016-10-12 12:06:45.0   external two
        2     second one      2016-10-11 14:30:25.0   my brand new future
        3     third one       2016-10-11 16:37:48.0   share the same change
        4     forth one       2016-10-12 12:06:18.0   external changes
        5     fifth one       2016-10-11 17:09:51.0   share the newer change
        6     sixth one       2016-10-11 13:34:12.0   have a rest
        7     seventh one     2016-10-11 14:31:12.0   exciting start
        8     eighth one      2016-10-11 16:38:23.0   higher value change
        9     nineth one      2016-10-12 12:06:18.0   external changes
```

**测试场景 8：将数据从 Hive 导出到 MySQL 中**

```
# 导出前，需要在 MySQL 中创建相应结构的表
mysql> create table my_exblog_back(id int not null primary key auto_increment, title varchar(64) not null, mtime timestamp, comment varchar(255));

# 执行导出任务， 其中 export-dir 表示要导出的 Hive 表在 HDFS 中的存储路径
sqoop export  --connect jdbc:mysql://192.168.120.8/test --username root --password p12cHANgepwD --table my_exblog_back -export-dir /user/hive/warehouse/test.db/my_exblog

# 查看导出成功后的数据
mysql> select * from my_exblog_back;
        +----+-------------+---------------------+------------------------+
        | id | title       | mtime               | comment                |
        +----+-------------+---------------------+------------------------+
        |  1 | first one   | 2016-10-11 17:09:51 | share the newer change |
        |  2 | second one  | 2016-10-11 14:30:25 | my brand new future    |
        |  3 | third one   | 2016-10-11 16:37:48 | share the same change  |
        |  4 | forth one   | 2016-10-12 12:06:18 | external changes       |
        |  5 | fifth one   | 2016-10-11 17:09:51 | share the newer change |
        |  6 | sixth one   | 2016-10-11 13:34:12 | have a rest            |
        |  7 | seventh one | 2016-10-11 14:31:12 | exciting start         |
        |  8 | eighth one  | 2016-10-11 16:38:23 | higher value change    |
        |  9 | nineth one  | 2016-10-12 12:06:18 | external changes       |
        | 10 | tenth one   | 2016-10-12 12:06:41 | external one           |
        | 11 | tenth one   | 2016-10-12 12:06:45 | external two           |
        +----+-------------+---------------------+------------------------+
```

**测试场景 9：将数据从关系数据库 MySQL 导入到列式数据库 HBase 中**

```
# 在 HBase 中创建表和字段簇
    bin/hbase shell
    hbase(main):001:0> create 'my_blog','content'

    # 执行导入数据的任务， 其中 hbase-row-key 表示将要以 MySQL 表中的什么字段作为 HBase 表中的 row-key
    sqoop-import --connect jdbc:mysql://192.168.120.19/test --username root --password p12cHANgepwD --table my_blog  --hbase-table my_blog --column-family content --hbase-row-key id
```
