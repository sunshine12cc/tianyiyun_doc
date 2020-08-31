---
---

# 多网卡配置策略路由的办法

## 网卡介绍

对于物理主机来说，网卡就是服务器的网络设备，用于接入以太网络，和其它计算机进行通信。QingCloud 网卡是基于虚拟化技术模拟的网卡设备，此设备是基于虚拟机所在的物理设备。QingCloud 云平台可以将集群内的虚拟网络统一起来，进行再分配。用户毋需关心具体的网卡在什么位置，有需要申请、挂接即可。

## 网卡使用限制

每个主机最多可以绑定 64 张网卡（其中主网卡 1 张，从网卡 63 张），而每个网络最多可以有 252 张网卡

## 申请网卡

通过控制台---计算---网卡---申请网卡

![img](../_images/image-1570687436357.png)

![img](../_images/image-1570687438995.png)

## 将网卡与主机绑定

![img](../_images/image-1570687440497.png)

## 登录到主机，查看网卡ip地址信息

![img](../_images/image-1570687442096.png)

## 配置策略路由办法

**1、使用以下的命令创建两张路由表**

[root@i-bs6l1wq8 ~]# echo "200    net1" >>/etc/iproute2/rt_tables

[root@i-bs6l1wq8 ~]# echo "201    net2" >>/etc/iproute2/rt_tables

[root@i-bs6l1wq8 ~]# echo "202    net3" >>/etc/iproute2/rt_tables

备注：路由表名称（net1、net2、net3）和路由表优先级（200、201、202，优先级数值越小表示优先级越高）

**2、查看路由表**

![img](../_images/image-1570687443964.png)

**3、执行以下命令，增加网卡路由策略**

ip r f t 200    ------清空路由表200的路由规则

ip r replace default via 172.16.10.1 dev eth0 src 172.16.10.2 table 200  ---添加默认路由到路由表200

ip ru a from 172.16.10.2 lookup 200  ----添加路由规则，凡是到172.16.10.2这个地址的ip就走路由表200



ip r f t 201    ------清空路由表201的路由规则

ip r replace default via 172.16.10.1 dev eth1 src 172.16.10.4 table 201  ---添加默认路由到路由表201

ip ru a from 172.16.10.4 lookup 201  ----添加路由规则，凡是到172.16.10.4这个地址的ip就走路由表201

ip r f t 202    ------清空路由表202的路由规则

ip r replace default via 172.16.10.1 dev eth2 src 172.16.10.3 table 202  ---添加默认路由到路由表

ip ru a from 172.16.10.3 lookup 202  ----添加路由规则，凡是到172.16.10.3这个地址的ip就走路由表202

**4、查看路由表的路由规则**

![img](../_images/image-1570687446390.png)

**5、测试网卡的连通性**

![img](../_images/image-1570687448108.png)

## 配置策略路由永久生效

**1、在/opt目录新建一个sh脚本文件，并编辑以下内容**

\#!/bin/bash

\#automake route

ip r f t 200

ip r replace default via 172.16.10.1 dev eth0 src 172.16.10.2 table 200

ip ru a from 172.16.10.2 lookup 200

ip r f t 201

ip r replace default via 172.16.10.1 dev eth1 src 172.16.10.4 table 201

ip ru a from 172.16.10.4 lookup 201

ip r f t 202

ip r replace default via 172.16.10.1 dev eth2 src 172.16.10.3 table 202

ip ru a from 172.16.10.3 lookup 202

![img](../_images/image-1570687450323.png)

**2、打开/etc/rc.d/rc.local文件，在末尾增加如下内容**

[root@i-bs6l1wq8 ~]# echo "sleep 10s" >> /etc/rc.local

[root@i-bs6l1wq8 ~]# echo "/opt/network.sh" >> /etc/rc.local

![img](../_images/image-1570687452034.png)

**3、分别给两个新增的文件增加执行权限**

[root@i-bs6l1wq8 ~]# chmod +x /etc/rc.local

[root@i-bs6l1wq8 ~]# chmod +x /opt/network.sh 

