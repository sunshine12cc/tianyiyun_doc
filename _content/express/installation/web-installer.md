---
---

# 使用 Web Installer 安装

青立方超融合易捷版 (CloudCube Express) 采用 Web Installer 对待安装机器及部署流程进行可视化部署，以极简的 “Step-by-Step” 安装方式引导用户快速配置节点安装环境。

## 前提条件

已参考 [预安装指南](preinstall.html) 完成了预安装步骤，并登陆至 Web Installer 页面。

## 准备节点

本示例准备了 IP 地址为 172.16.76.3 - 172.16.76.5 共 3 台机器用于演示，满足最小安装要求，以下步骤演示安装步骤。

![](https://pek3b.qingstor.com/kubesphere-docs/png/20190425083813.png)

## 第一步：基本信息

在基本信息中，可根据实际环境自定义域名、区域 ID、控制台名称、网络协议、管理网络范围，本安装示例填写的信息如下：


> - 域名：即CloudCube Express在浏览器中最终的访问地址，例如 expresscloud.com；
> - 区域 ID：可自定义区域 ID 值，没有规则限制，为方便理解可设置如 pek3 (北京 3 区)，gd2 (广东 2 区)；
> - 控制台名称：可自定义易捷版控制台界面的名称，例如青立方超融合易捷版；
> - 网络协议：此处默认采用http
> - 管理网络范围：此处输入待安装机器可管理的网段地址，本示例为 172.16.76.3-172.16.76.200，例如待安装机器的起始 IP 地址为 172.16.76.3，则管理网络范围的区间可位于 172.16.76.3-172.16.76.254 区间，需保证该范围中部分网段未被占用。


完成基本信息后点击 「下一步」。

![](https://pek3b.qingstor.com/kubesphere-docs/png/20190425085220.png)

## 第二步：节点设置

1、节点设置中，需添加至少 3 个节点才可满足最小安装要求，点击 「添加节点」。

2、在弹窗中，输入预先准备的 3 台 IP 地址连续的机器 IP 段：**172.16.76.3 - 5**，完成后点击 「扫描可用节点」。

> 提示：安装程序将自动过滤掉用户所输入 IP 段中空缺的 IP，如果准备了 4 台节点 172.16.76.3 - 172.16.76.5 和 172.16.76.7，直接输入 172.16.76.3 - 7 即可扫描到这四台节点。


![](https://pek3b.qingstor.com/kubesphere-docs/png/20190531154709.png)

3、在节点设置中可以看到扫描到的可用节点，即当前准备的 3 台机器以及待安装机器的节点角色和节点信息，默认无需修改节点角色。

![](https://pek3b.qingstor.com/kubesphere-docs/png/20190531154748.png)

4、点击 「编辑节点」，进入查看节点的详情，其中磁盘类型支持混合。注意，请进入每一个节点检查其默认的数据盘类型，必须保证 `每个节点的数据盘至少有一块 SSD 类型的磁盘`，否则安装可能会失败。验证完毕后，点击右上角关闭按钮将**自动保存生效**。

![](https://pek3b.qingstor.com/kubesphere-docs/png/20190531160012.png)

## 第三步：可选服务

点击 「下一步」，可根据需要选装 [QingCloud 桌面云](https://www.qingcloud.com/products/qingcloud-desktop/) 提供企业级的桌面云服务，QingCloud 桌面云是基于 QingCloud IaaS 平台研发的新一代企业级办公解决方案。

![](https://pek3b.qingstor.com/kubesphere-docs/png/20190425092649.png)

## 第四步：安装 & 预览

1、检查安装预览页中的基本信息和节点设置信息，确认无误后点击 「安装」，配置和部署步骤将自动进行。

> 注：安装过程中如果关闭了浏览器或者相应的安装页面，安装过程在后台仍将继续执行，重新打开该页面，即可回到刚才的安装部署状态。

![](https://pek3b.qingstor.com/kubesphere-docs/png/20190531155801.png)

![](https://pek3b.qingstor.com/kubesphere-docs/png/20190425143949.png)

2、若节点配置正确且安装过程中未报错，即安装成功。


3、进入运维管理的基本信息页面，试用 license 默认一个月，需要在到期前输入新的 license 激活产品。点击「点击访问」通过访问地址访问 console 页面。

> 注意：此时需要将访问地址下的所有 hosts 记录添加到本地的 hosts 文件中。使用 Windows 进行访问的用户，可在 `c:\windows\system32\drivers\etc\hosts` 文件中添加。使用 Linux 和 Mac OS 访问的用户，可在 `/etc/hosts` 文件中添加。

![](https://pek3b.qingstor.com/kubesphere-docs/png/20190527095959.png)

4、访问内网域名 `console.expresscloud.com` 即可打开 CloudCube Express 登录页面，默认用户名和密码如下： 

- 用户名：admin@domain (domain 是在第一步基本信息中用户设置的域名，例如本示例是 `admin@expresscloud.com`)
- 密码：zhu88jie

> 提示：选装了桌面云后，可通过域名 `desktop.expresscloud.com` 来访问，默认使用 `admin / zhu88jie` 登录。部署桌面云应用后，可使用桌面云的 `desktop@expresscloud.com / zhu88jie` 账号登录 CloudCube Express 管理桌面云的资源。

![](https://pek3b.qingstor.com/kubesphere-docs/png/20190526135900.png)

## 运维管理

### 基本信息

基本信息页面支持查看当前安装环境的域名和版本信息，以及访问地址。

![](https://pek3b.qingstor.com/kubesphere-docs/png/20190527095959.png)

### 高级设置

高级设置中，支持安装 QingCloud 桌面云 (可选)，从本地上传安装包来对软件更新升级、上传镜像以及更新补丁等功能。

> 注意：用户在首次完成平台的安装部署后，需要通过点击 「上传镜像」 功能，将环境所需的基础镜像 img 文件上传到系统镜像，以便用户在创建虚拟机时可从系统镜像中进行选择。

![](https://pek3b.qingstor.com/kubesphere-docs/png/20190527143515.png)

**下载与上传镜像**

1、青云 QingCloud 将为您提供基础的系统镜像，您可以通过填写 [申请表单](http://marketing.qingcloud.com/expressapplication) 来申请系统镜像。

2、获取到镜像的下载地址后，可以自行下载所需的系统镜像并上传至 web-installer。然后在 web-installer 的 「高级设置」 的上传镜像一栏点击 「上传」。

![](https://pek3b.qingstor.com/kubesphere-docs/png/20190621003254.png)

3、在本地选择已下载的系统镜像，例如 `seed-image-system-fedora.tar.gz`。

![](https://pek3b.qingstor.com/kubesphere-docs/png/20190621003428.png)

4、如下示例镜像已上传成功。

![](https://pek3b.qingstor.com/kubesphere-docs/png/20190621010932.png)

### 服务巡检

服务巡检会对平台节点上的所有服务进程进行健康检查，检查完毕后将如下展示服务进程的健康状态。只有当节点各项服务均为健康状态时才可以正常使用，如果平台某项服务运行异常，请尝试再次检查并联系我们提供技术支持。

![](https://pek3b.qingstor.com/kubesphere-docs/png/20190527095143.png)

### 功能测试

功能测试可以对青立方超融合易捷版进行功能测试，来验证产品功能的可靠性，仅用于第一次安装时对平台功能进行检查，测试完毕后无法进行二次测试。

![](https://pek3b.qingstor.com/kubesphere-docs/png/20190527095555.png)

### 添加节点

若安装完成后还需要再次添加节点，可点击左下方的 「添加节点」，在弹窗中输入新节点的 IP 信息，然后点击 「扫描可用节点」。例如需要再添加两台机器，则将 172.16.76.8-9 填入即可。

![](https://pek3b.qingstor.com/kubesphere-docs/png/20190531165141.png)



























