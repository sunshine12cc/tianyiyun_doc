---
---

# 与物理设备 IPsec 互联

以上例子是青云路由器之间做 IPsec 互联。青云路由器也可以和具有 IPsec 功能的物理设备（路由器、防火墙等）做互联。

## **现阶段青云路由器 IPsec 的支持参数**

**支持参数自动匹配、自动协商。**

MODE:               main[主模式]/aggrmode[野蛮模式]

TYPE:               tunnel

IKE:                ikev1(默认)/ikev2

IKE encrypt:        AES(默认)/3DES

ESP encrypt:        AES（默认）/3DES/DES/CAST/BLOWFISH/CAMELLIA/SERPENT/TWOFISH

IKE SA lifetime:    3600s

IPsec SA lifetime:  28800s

HASH:               MD5/SHA1(默认)/SHA2

DH-GROUP:           2/5/14（默认）/15/16/17/18/22/23/24

PFS:                up

NAT-Traversal:      up

AUTH:               PSK

DPDDelay:           15s

通常在物理设备上需要显式地定义 IPsec 的 加密集(encryption和HASH)、DH group、lifetime、access-list、路由、NAT豁免等。

如果对接的物理设备在内网，需要在青云路由器的 IPsec 配置 “对端设备ID”，通常填写所对接内网的网关IP。

假设本地私有网络为 192.168.1.0/24，青云私有网络为 192.168.100.0/24，本地公网地址为 88.88.88.88，青云路由器公网地址为 99.99.99.99。

## 以 Cisco ASA 设备为例

**使用 cli 进行配置，主要包含了 crypto-map、access-list、psk、tunnel 的配置文本:**

ASA(config)# access-list my_nat extended permit ip 192.168.1.0 255.255.255.0 192.168.100.0 255.255.255.0

ASA(config)# access-list cisco-to-qingcloud extended permit ip 192.168.1.0 255.255.255.0 192.168.100.0 255.255.255.0

ASA(config)# nat (inside) 0 access-list my_nat



ASA(config)# crypto ipsec transform-set ESP-3DES-MD5 esp-3des esp-md5-hmac

ASA(config)# crypto ipsec security-association lifetime seconds 28800

ASA(config)# crypto ipsec security-association lifetime kilobytes 4608000



ASA(config)# crypto map my_map 1 match address cisco-to-qingcloud

ASA(config)# crypto map my_map 1 set pfs

ASA(config)# crypto map my_map 1 set peer 99.99.99.99

ASA(config)# crypto map my_map 1 set transform-set ESP-3DES-MD5

ASA(config)# crypto map my_map interface outside

ASA(config)# crypto isakmp enable outside

ASA(config)# crypto isakmp policy 10

ASA(config-isakmp)# authentication pre-share

ASA(config-isakmp)# encryption 3des

ASA(config-isakmp)# hash md5

ASA(config-isakmp)# group 2

ASA(config-isakmp)# lifetime 3600

ASA(config)# crypto isakmp nat-traversal 60



ASA(config)# tunnel-group 99.99.99.99 type ipsec-l2l

ASA(config)# tunnel-group 99.99.99.99 ipsec-attributes

ASA(config-tunnel-ipsec)# pre-shared-key *****

## **以 H3C Router 设备为例**

**使用 cli 进行配置，主要包含了 transform-set、policy、profile、proposal、psk、acl 的配置文本:**

\#

acl number 3100

 rule 10 permit ip source 192.168.1.0 0.0.0.255 destination 192.168.100.0 0.0.0.255



\#

ipsec transform-set tran1

 esp encryption-algorithm aes-cbc-128

 esp authentication-algorithm sha1

 pfs dh-group14



\#

ipsec policy map1 10 isakmp

 transform-set tran1

 security acl 3100

 remote-address 99.99.99.99

 ike-profile profile1

 sa duration time-based 28800



\#

ike profile profile1

 keychain keychain1

 local-identity address 88.88.88.88

 match remote identity address 99.99.99.99 255.255.255.255

 proposal 1



\#

ike proposal 1

 encryption-algorithm 3des-cbc

 dh group14

 sa duration 3600

\#

ike keychain keychain1

 pre-shared-key address 99.99.99.99 255.255.255.255 key cipher *****

> 依物理设备的品牌和型号，IPsec 的配置方法会存在差异性。请参阅设备的用户手册确定正确的配法。