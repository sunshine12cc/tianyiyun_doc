---
---

# 主从双节点数据复制的 Datacheck

登录 PostgreSQL DB 后，在主节点上执行以下 sql ，新建 test table 并插入数据。

```sql
create table t_user (id int primary key,val varchar(30));
insert into t_user  values(1,'Raito');  
insert into t_user  values(2,'Emily');
select * from t_user;
```

登录 PostgreSQL DB 后，在从节点上执行以下 sql ，查看该表数据，查看数据是否和主节点一致。

```sql
select * from t_user;
```

