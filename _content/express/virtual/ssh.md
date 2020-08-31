---
---

# SSH 密钥

SSH 密钥可以为主机的 root 用户设置 SSH 公钥，当主机启动后，用户可使用 SSH 密钥进行 SSH 无密码登录。相对于用户名密码方式，密钥方式拥有更强的安全性，也可以很大程度阻止暴力破解的发生。目前常用的密钥都是非对称性的加密方式，主机内置公钥，而用户则拥有私钥。由于采用非对称加密，入侵者试图通过公钥去破解私钥难度会远远超出密码的破解。

## 创建 SSH 密钥

1. 点击 「虚拟资源」，选择 「SSH 密钥」，然后点击 「+ 创建 SSH 密钥」。

![](https://pek3b.qingstor.com/kubesphere-docs/png/20190411230348.png)

2. 在弹窗中，填写密钥名称，目前支持两种创建方式：创建新密钥和使用已有公钥。

![](https://pek3b.qingstor.com/kubesphere-docs/png/20190411230853.png)

3. 点击 「下载」，将密钥保存至本地。

![](https://pek3b.qingstor.com/kubesphere-docs/png/20190411231159.png)

## 加载密钥至主机

勾选新建的密钥，点击 「加载密钥至主机」。

![](https://pek3b.qingstor.com/kubesphere-docs/png/20190411231327.png)

选中其中一台主机，点击 「确定」。

![](https://pek3b.qingstor.com/kubesphere-docs/png/20190411231456.png)


## 如何使用 SSH 密钥来访问主机？

将密钥加载至主机并下载密钥文件（例如 kp-1234abcd ）后，可参考如下步骤访问主机。

> 注解：在进行 SSH 连接之前，请确保在主机对应的防火墙下行规则中打开 TCP 22 号端口的访问。

![](https://pek3b.qingstor.com/kubesphere-docs/png/20190411232819.png)

### Linux 和 Mac OS

下载 SSH 密钥 (如 kp-1234abcd) 至本地后，Linux 和 Mac OS 下，使用下面的命令登录：

```
# chmod 600 /path/to/kp-1234abcd
# ssh -i /path/to/kp-1234abcd root@ip_address
```

例如，使用 SSH 密钥连接主机  `172.31.45.132`：

> 注意：SSH 密钥只能用于连接 root 用户。

```
# chmod 600 /path/to/kp-1234abcd
# ssh -i /path/to/kp-1234abcd root@172.31.45.132
```

![](https://pek3b.qingstor.com/kubesphere-docs/png/20190413171149.png)

### Windows

#### Windows 下用 putty

很多 Windows 桌面用户都会使用著名的 PuTTY 作为 SSH 客户端来登录远程的 Linux 主机，但是 PuTTY 不支持 OpenSSH 的密钥格式，而是使用它自己的密钥格式。因此，PuTTY 提供了一个名为puttygen的密钥格式转换工具。

- 首先 [点击此处](http://www.chiark.greenend.org.uk/~sgtatham/putty/download.html) 下载 putty 和 puttygen。

- 转换密钥格式

启动 puttygen，点击 Conversions -> Import key，选中您在青云中创建并下载的 SSH 密钥，文件名形如 kp-1234abcd。然后点击 Save private key，您将得到 PuTTY 格式的私钥，如kp-1234abcd.ppk

- 配置登录

打开 putty。

点击 putty 左边导航的 connection -> data, auto-login username 处填入登录名：root

点击 putty 左边导航的 connection -> ssh -> auth, 最下面有 private key file for authantication 字样，点击旁边的 browse，选择之前生成的 kp-1234abcd.ppk 文件，确定。

点击 putty 左边导航的 session，host name 中填写主机的 IP 地址，例如1.2.3.4。

最后点击下面的 open 进行连接即可。

如果想下次登录方便，可以点击 putty 左边导航的 session，在 save sessions 中填入名称并保存，将当前配置保存下来。

#### Windows 下使用 SecureCRT

> 注解 推荐使用 SecureCRT 6.5 及以上版本，低版本会出现私钥无法导入的情况。

- 将密钥加载到主机上并下载私钥文件，例如 kp-12345678；

- 在 SecureCRT 上创建一个新连接，protocol 是 SSH2，hostname 是 IP 地址，username 为 root；
- 右键选中这个 session，选择 Properties，在 Connection -> SSH2 的 Authentication 面板里面，选中 PublicKey，点击右边的上箭头，将这个选项排到第一位；
- 继续选中 PublicKey，点击右边的 Properties，选择 Use session public key setting，在下面的 Use identity or certificate file，导入下载的私钥文件 kp-12345678；
- 连接即可。

在较低版本的 SecureCRT 可能会遇到无法导入私钥的问题，因为低版本的 SecureCRT 会严格要求私钥需要和公钥共同存在，这种情况下，操作步骤如下：

- 在控制台创建 SSH 密钥，将这个密钥加载到主机上并下载私钥文件，例如放置于 `/path/to/kp-1234abcd` ；
- 在路径 `/path/to/` 下创建新文件 `kp-1234abcd.pub`；
- 在 SSH 密钥 kp-1234abcd 的详情页中找到公钥的字符串，并拷贝下来放入 kp-1234abcd.pub 文件中，并且在公钥内容前面加上加密方式，最终文件内容为：`ssh-rsa AAAAB3NzaC1yc2EAAAADAQABAAABAQC90PM9PT……..`；
- 在 SecureCRT 上创建一个新连接，protocol 是 SSH2，hostname 是 IP 地址，username 为 root；
- 右键选中这个 session，选择 Properties，在 Connection -> SSH2 的 Authentication 面板里面，选中 PublicKey，点击右边的上箭头，将这个选项排到第一位；
- 继续选中 PublicKey，点击右边的 Properties，选择 Use session public key setting，在下面的 Use identity or certificate file，导入下载的私钥文件 kp-12345678；
- 连接即可。

#### Windows 下使用 Xshell

推荐使用 Xshell 5 及以上版本

- 将这个密钥加载到主机上并下载私钥文件，例如 kp-12345678；
- 在 Xshell 上 创建 (New) 一个新 会话(Session) ，协议(Protocol) 是 SSH，主机(Host) 是 IP 地址；
- 左侧标签中切换到 用户身份验证(Authentication)，右侧表单中 方法(Method) 选择 Public Key ，用户名(Username) 为 root ，点击 用户密钥(User Key) 左侧 浏览(Browse) 按钮；
- 选择并 导入(Import) 刚才下载的私钥文件 kp-12345678；
- 连接即可。