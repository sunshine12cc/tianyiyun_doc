---
---

# 用户管理

## 创建本地用户

您可以创建多个本地用户，每个用户可自主管理和部署名下的资源，不同用户之间的资源是相互隔离的。

1、点击 「用户管理」 → 「创建用户」。

![](https://pek3b.qingstor.com/kubesphere-docs/png/20190527091634.png)

2、在弹窗中输入登录邮箱和密码，点击 「创建」 即可。

![](https://pek3b.qingstor.com/kubesphere-docs/png/20190527091824.png)

3、新用户创建成功。

![](https://pek3b.qingstor.com/kubesphere-docs/png/20190527091941.png)

## 修改用户或重置密码

点击右侧 **···** 可查看更多选项，如修改用户名称和邮箱、重置密码、禁用用户以及备注等选项。

![](https://pek3b.qingstor.com/kubesphere-docs/png/20190527092124.png)

## 第三方登录

第三方登录支持接入管理（AD、LDAP），当使用第三方服务的方式进行接入对接时，需用户输入相关属性信息，之后会自动创建一个与该用户关联的本地用户，便于环境的安全接入登陆。

> 前提条件：已安装和准备了 AD/LDAP 服务器，若还未准备可参考 [Auth0 Docs](https://auth0.com/docs/connector) 自行搭建服务。

![](https://pek3b.qingstor.com/kubesphere-docs/png/20190527092939.png)

1、在 「第三方登录」 页面点击 「创建第三方服务器」，输入如下信息，确保该服务器与当前系统的网络环境是连通的。

> - 名称：为第三方服务器起一个简洁明了的名称，便于用户浏览和搜索。
> - 类型：支持 LDAP 和 AD 类型的服务器，根据实际情况选择
> - 服务器ID：服务器的 IP 地址
> - 端口：服务器对外暴露的端口号
> - 基准：例如 ou=People,dc=yunify,dc=com
> - 管理员账号与密码：按实际环境输入，请确保登录账号密码准确

![](https://pek3b.qingstor.com/kubesphere-docs/png/20190527092415.png)

2、点击 「创建」 即可完成添加。

![](https://pek3b.qingstor.com/kubesphere-docs/png/20190527093143.png)

3、添加成功后将自动导入该服务器用户目录中的所有用户，用户可通过 AD/LDAP 的方式登录。





