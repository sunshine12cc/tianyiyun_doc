---
---

# 镜像

镜像（Image）是一个包含了软件及必要配置的机器模版。作为基础软件，操作系统是必须的，您也可以根据自己的需求将任何应用软件 （比如，数据库、中间件等）放入镜像中。

登录控制台后，选择 「虚拟资源」 → 「镜像」，进入镜像管理页面。

![](https://pek3b.qingstor.com/kubesphere-docs/png/20190523205650.png)

目前镜像支持 **注册镜像** 和 **基于镜像创建主机**。

## 注册镜像

可点击右侧 「注册镜像」。注册镜像目前支持从本地上传 iso、iz4、img 这三种格式的镜像文件。注册时需要用户预先准备好镜像，并填写以下配置信息：

> - 名称：为镜像起一个简洁明了的名称，便于用户浏览和搜索。
> - 上传镜像：点击即可从本地上传符合平台支持类型的镜像文件。
> - 镜像类型：支持普通镜像和 ISO 镜像。
> - 控制器类型：支持 virtio、scsi 和 ide 三种类型。
> - 系统盘容量：设定该主机镜像的系统盘大小，0 GB ~ 100 GB。
> - 系统相关信息：
>     - 目前支持 Linux、Windows 和 Unix，请根据您上传镜像的系统类型选择。
>     - 操作系统目前支持 CentOS、Ubuntu、Debian、Fedora、SUSE、Arch、Oracle Linux、CoreOS 等，请根据您上传镜像的系统类具体型进行选择。
>     - 请根据您上传镜像的系统类具体型进行选择操作系统的位数，支持 32 位和 64 位。
> - 在描述空白框设定主机镜像的默认管理员与密码，如 `root,password`。

![注册镜像](https://pek3b.qingstor.com/kubesphere-docs/png/20190405103649.png)

初次使用时，可登录 CentOS、Ubuntu 官网直接下载相应的镜像用于测试使用：

- CentOS： 镜像源[下载地址](http://59.80.44.49/isoredirect.centos.org/centos/7/isos/x86_64/CentOS-7-x86_64-DVD-1810.iso)。
- Ubuntu：镜像源[下载地址](https://www.ubuntu.com/download)。

### 注册镜像示例

以下用一个简单示例说明如何从注册镜像到基于镜像创建主机。

例如，可以从 [Ubuntu 官网](https://www.ubuntu.com/download) 下载的 ubuntu-18.04.2-live-server-amd64.iso 镜像后，然后参考以上提示信息上传镜像至平台，注意镜像类型选择 `ISO` 镜像。

注意，上传镜像的时间取决于镜像大小，通常在几十秒内，注册完成后，如下所示为注册成功的镜像。

![](https://pek3b.qingstor.com/kubesphere-docs/png/20190523205951.png)

## 基于镜像创建主机

> 注意：基于镜像创建之前，需要先注册用户上传的本地镜像，或者预先将主机制作成镜像。

主机（Instance）是以虚拟机的形式运行在 青立方超融合易捷版中的镜像副本。基于一个镜像，您可以创建任意数量的主机。在创建主机时，您需要指明 CPU、内存和系统盘等配置。

![](https://pek3b.qingstor.com/kubesphere-docs/png/20190523210911.png)

1、勾选列表中之前注册的镜像 `ubuntu-demo-image`，点击「基于镜像创建主机」。

2、在弹窗中填写待创建虚拟机的基本信息，支持自定义虚拟机配置，可参考文档 [虚拟机](../virtual/vm) 进行创建。如下创建了一台入门配置的虚拟机，名称为 `ubuntu-image-based`。

![](https://pek3b.qingstor.com/kubesphere-docs/png/20190523211059.png)


3、完成基本信息配置后，点击「创建」即可基于当前镜像创建新的虚拟机。

4、回到虚拟机列表，查看新建的虚拟机 `ubuntu-image-based`。

![](https://pek3b.qingstor.com/kubesphere-docs/png/20190523211203.png)

## 创建镜像

### 基于虚拟机创建镜像

1、基于虚拟机创建镜像需要预先将虚拟机关机后才可以创建镜像。例如在虚拟机列表点击右侧 **···** 然后选择 「制作成镜像」，即可将当前虚拟机制作成镜像。

![](https://pek3b.qingstor.com/kubesphere-docs/png/20190525094629.png)

2、填写镜像名后，新镜像制作将自动进行。

### 基于备份创建镜像

1、平台还支持基于备份创建镜像，若您的虚拟机已经创建过备份，可基于其中的一个备份点创建镜像，参考如下步骤。

![](https://pek3b.qingstor.com/kubesphere-docs/png/20190525095022.png)

2、填写镜像名后，新镜像制作将自动进行，可以看到基于该备份点新创建的镜像。

![](https://pek3b.qingstor.com/kubesphere-docs/png/20190525095204.png)

## 删除或修改镜像

点击右侧 `···` 选择修改或删除即可修改镜像描述或删除镜像。

![](https://pek3b.qingstor.com/kubesphere-docs/png/20190523213243.png)









