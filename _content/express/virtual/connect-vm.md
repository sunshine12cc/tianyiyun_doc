---
---

# 连接虚拟机

连接虚拟机的方式根据不同的系统类型 (Linux、Windows) 有不同的连接方法。

## 浏览器 Web 连接

1、进入主机列表页，点击 「连接远程桌面」的图标，将自动打开远程连接 ( VNC ) 的会话窗口。

![](https://pek3b.qingstor.com/kubesphere-docs/png/20190524165954.png)

2、输入设置的用户名和密码即可。注意，如果主机不接受您的密码，您可以先关闭主机，然后修改主机密码。

![](https://pek3b.qingstor.com/kubesphere-docs/png/20190524170220.png)

## Linux 主机

### 通过 SSH Terminal 终端连接

若 Linux 主机网络与终端设备在同一内网环境中，可直接通过命令 `ssh root@IP -p 22` 和 root 用户密码来登录虚拟机。注意，ubuntu 主机的默认登录用户为 ubuntu 而非 root 用户。

### 通过 SSH 密钥连接

相对于用户名密码方式，密钥方式拥有更强的安全性，也可以很大程度阻止暴力破解的发生。目前常用的密钥都是非对称性的加密方式，主机内置公钥，而用户则拥有私钥。由于采用非对称加密，入侵者试图通过公钥去破解私钥难度会远远超出密码的破解。可参考 [SSH 密钥](ssh.html)。

### 通过第三方软件连接

1、除了通过 VNC 连接外，您也可以通过第三方软件连接至虚拟机，常见的软件有 [PuTTY](https://www.putty.org/) 、[Xshell](https://www.netsarang.com/zh/xshell/)。

2、例如使用 Putty，在 Session 页面输入 IP 地址，点击 Open。

![](https://pek3b.qingstor.com/kubesphere-docs/png/20190524171029.png)

3、输入用户名和密码即可登录。

## Windows主机

从安全考虑，平台上的 Windows 主机默认关闭了远程登录，您首先需要通过浏览器 Web 方式登录到主机，并开启远程登录功能

### 第一步：Windows Server 开启远程登录

1、浏览器打开 VNC，连接 Windows Server。

2、在 Web 登录页面，点击左上角 `Ctrl-Alt-Del` ，然后输入设置的密码。

![](https://pek3b.qingstor.com/kubesphere-docs/png/20190524171546.png)

3、同意内部网络共享。

登录后会弹出网络共享的界面，点击 `是`，允许VPC内部的网络。

![](https://pek3b.qingstor.com/kubesphere-docs/png/20190524171636.png)

4、打开系统属性。

在 Windows 主机中，点击下方文件管理器，依次点击 `此电脑` - `计算机` - `系统属性`。

![](https://pek3b.qingstor.com/kubesphere-docs/png/20190524171722.png)

5、允许远程桌面连接。

然后，点击 `远程设置` ，在远程桌面处选择 `允许远程桌面连接`。

![](https://pek3b.qingstor.com/kubesphere-docs/png/20190524171800.png)

### 第二步：Windows 远程桌面连接

您可以通过 Windows 系统自带的 `远程桌面连接` 连接 Windows Server ，然后输入用户名密码即可。

![](https://pek3b.qingstor.com/kubesphere-docs/png/20190524171852.png)