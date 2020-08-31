---
---

# qsfs 文档

qsfs 是基于 FUSE 的文件系统，允许 Linux 将 QingStor Bucket 挂载在本地文件系统。

本工具为 Alpha 版本，仅作为试用用途来使用，不能用于服务器生产环境下。

qsfs 已在 GitHub 开源，更多详情可参见 [https://github.com/yunify/qsfs-fuse](https://github.com/yunify/qsfs-fuse)。

## 准备工作

使用 qsfs 之前需要创建 Bucket，并获取一对 API 密钥，API 密钥可以在 [青云控制台](https://console.qingcloud.com/access_keys/) 申请。

## 安装

### 源码安装

#### 1. 编译要求

GCC 4.1.2 或更高版本

[CMake](https://cmake.org/install/) 3.0 或更高版本

#### 2. 安装依赖

qsfs 是基于 FUSE 的文件系统，需要安装 libfuse。

qsfs 使用了 [QingStor SDK for C++](https://docs.qingcloud.com/qingstor/sdk/cpp/)，需要安装 SDK 的依赖库： libcurl 和 libopenssl。

可以参照以下方法，在你所使用的 Linux 发行版本对应的 package manager 中找到这些依赖库:

在 Debian/Ubuntu 系列系统请使用以下命令安装

```bash
> sudo apt-get install fuse libfuse-dev libcurl4-openssl-dev libssl-dev
```

在 Redhat/Fedora 系列系统请使用以下命令安装

```bash
> sudo yum install fuse fuse-devel libcurl-devel openssl-devel
```

#### 3. 采用CMake编译源码并安装

从 GitHub 仓库 [yunify/qsfs-fuse](https://github.com/yunify/qsfs-fuse) clone 源码:

```bash
> git clone https://github.com/yunify/qsfs-fuse.git
```

建立 build 目录：

```bash
> cd PROJECT_DIR
> mkdir build
> cd build
```

运行 CMake 命令：

```bash
> cmake ..
```

> 注意 该过程中会通过 git 下载 QingStor SDK for C++，glog以及gtest，并安装 QingStor SDK for C++，所以该过程需要获取 root 权限。

如果需要运行单元测试，请按照以下命令执行 CMake 命令：

```bash
> cmake -DBUILD_TESTING=ON ..
```

编译：

```bash
> make
```

运行单元测试：

```bash
> make test
```

安装：

```bash
> [sudo] make install
```

卸载：

```bash
> [sudo] make uninstall
```

清除编译产生的文件，直接移除 build 目录即可：

```bash
> rm -rf build
```

更多详情可访问 GitHub 项目的 [安装文档](https://github.com/yunify/qsfs-fuse/blob/master/INSTALL.md)。

### 采用安装包安装

#### 1. 安装依赖

参考上一节的源码安装中的依赖安装方法．

#### 2. 下载相应安装包

可访问 GitHub 项目的 [Releases](https://github.com/yunify/qsfs-fuse/releases) 页面查看和下载安装包。最新的安装包版本为 1.0.11-alpha

最新版本下载链接如下：

- [qsfs-1.0.11-alpha.el6_8.x86_64.rpm](https://github.com/yunify/qsfs-fuse/releases/download/v1.0.11-alpha/qsfs-1.0.11-alpha.el6_8.x86_64.rpm)
- [qsfs-1.0.11-alpha.el7_2.x86_64.rpm](https://github.com/yunify/qsfs-fuse/releases/download/v1.0.11-alpha/qsfs-1.0.11-alpha.el7_2.x86_64.rpm)
- [qsfs_1.0.11-alpha_Ubuntu14.04_amd64.deb](https://github.com/yunify/qsfs-fuse/releases/download/v1.0.11-alpha/qsfs_1.0.11-alpha_Ubuntu14.04_amd64.deb)
- [qsfs_1.0.11-alpha_Ubuntu16.04_amd64.deb](https://github.com/yunify/qsfs-fuse/releases/download/v1.0.11-alpha/qsfs_1.0.11-alpha_Ubuntu16.04_amd64.deb)

#### 3. 安装

在 Debian/Ubuntu 系列系统请使用以下命令安装

```bash
> sudo dpkg -i <qsfs_package.deb>
```

在 Redhat/Fedora 系列系统请使用以下命令安装

```bash
> sudo rpm -i <qsfs-package.rpm>
```

## 快速开始

### 1. 配置访问密钥

使用 qsfs，需要有一个配置文件来设置你的访问密钥 (注意需要设置密钥文件的权限为 600)

   ```bash
   > echo YourAccessKeyId:YourSecretKey > /path/to/cred
   > chmod 600 /path/to/cred
   ```

> 注意
> 1. 密钥对需到 [青云控制台](https://console.qingcloud.com/access_keys/) 申请并按如上格式写入到密钥配置文件,请不要遗忘中间的冒号分隔符, 不需要添加引号. 例如:
>
>    CUEGWBMEUXIRMZUZDFD:jPZNMvFAuVPhycoRKu252rGjtwpYpihVOy5AWo9S
>
> 2. 如果创建密钥文件为默认路径名(`/etc/qsfs.cred`), 则挂载时不需要指定密钥文件路径.

### 2. 挂载 Bucket 到本地目录

   ```bash
   > mkdir -p /path/to/mountpoint
   > qsfs mybucket /path/to/mountpoint -z=sh1a -c=/path/to/cred
   > df -T | grep qsfs
   qsfs           fuse.qsfs 18014398509481980   0 18014398509143496   0% /path/to/mountpoint
   ```

> 注意 存储桶名字(如 `mybucket`), 挂载点(如 `/path/to/mountpoint`) 和所在区域(如 `-z=sh1a`)是必填选项, 密钥文件若配置为默认路径 `/etc/qsfs.cred` 则可不指定. 私有云用户还需要通过 `-H` 指定 host.
>
> 例如, 某私有云的 bucket 地址如下:
> ```sh
> bucketname.zonename.stor.xxxcloud.yyy.com
> ```
> 则挂载命令为:
> ```sh
> qsfs bucketname /path/to/mountpoint -z=zonename -H=stor.xxxcloud.yyy.com -c=/path/to/cred
> ```

### 3. 卸载

```bash
fusermount -u /path/to/mountpoint
```

或者

```bash
umount /path/to/mountpoint
```

如果遇到类似 `filesystem is busy` 的提示, 可以打开 lazy 选项进行卸载.

```bash
fusermount -uz /path/to/mountpoint
```

或者

```bash
umount -l /path/to/mountpoint
```

### 4. 测试文件系统操作

   ```bash
   > echo 'hello world' > /tmp/hello.txt
   > cp -v /tmp/hello.txt /path/to/mountpoint/
   ‘/tmp/hello.txt’ -> ‘/path/to/mountpoint/hello.txt’
   > ls -l /path/to/mountpoint/hello.txt
   -rw-r--r-- 1 root root 12 2月  23 22:22 ./hello.txt
   > cat /path/to/mountpoint/hello.txt
   hello world
   ```

### 5. 配置开机自动挂载 qsfs

第一步，在 /etc/fstab 文件中添加以下命令行并保存：

```bash
# <file system> <mount point>       <type>  <options>                                     <dump> <pass>
qsfs#mybucket   /path/to/mountpoint  fuse   _netdev,-z=pek3a,-c=/path/to/cred,allow_other    0     0
```

> 注意　
> 1. 第一项 file system 填写格式为 `qsfs#BUCKET_NAME`, 其中 `BUCKET_NAME` 为存储桶名.
> 2. 在第四项设置 qsfs 挂载选项时需要使用短选项格式，例如 `-c` 而不是 `--credentials` ，若配置为默认路径 `/etc/qsfs.cred` 则可不必在命令行中再次设置该选项. 私有云还需要通过 `-H` 选项配置 host.

第二步，执行以下命令验证开机挂载 qsfs 配置的正确性：

```bash
> mount -a
```

> 注意
> 1. 配置正确则执行命令后不会有信息提示，可通过如下命令检查是否挂载成功：
> ```bash
> > df -Th | grep qsfs
> ```
> 2. 务必确保挂载目录没有被挂载且该目录为空；如果提示如下信息，可能是挂载目录非空或者已经挂载该目录：
> ```bash
> fuse: mountpoint is not empty
> fuse: if you are sure this is safe, use the 'nonempty' mount option
> [qsfs ERROR] Unable to mount qsfs
> ```
> 3. centos6.5 系统还需要执行以下命令：
> ```bash
> > chkconfig netfs on
> ```

## 使用示例

在`sh1a` 区有一个名为 `jimbucket1` 的 Bucket, 其 Url 为 `http://jimbucket1.sh1a.qingstor.com`; 打算将该存储桶挂载到本地目录 `/mnt/jimbucket1`.

通过[青云控制台](https://console.qingcloud.com/access_keys/) 申请的密钥对如下:

```bash
qy_access_key_id: CUEGWBMEUXIRMZUZDFD
qy_secret_access_key: jPZNMvFAuVPhycoRKu252rGjtwpYpihVOy5AWo9S
```

首先, 我们需要设置密钥对文件, 将密钥对文件内容按 `qy_access_key_id:qy_access_key_id` 格式填入, 并将其权限修改为 `600`.

```bash
echo CUEGWBMEUXIRMZUZDFD:jPZNMvFAuVPhycoRKu252rGjtwpYpihVOy5AWo9S > /etc/qsfs.cred #这里采用默认密钥文件路径
chmod 600 /etc/qsfs.cred
```

接下来, 通过如下命令进行挂载即可:

```bash
sudo qsfs jimbucket1 /mnt/jimbucket1 -z=sh1a -o allow_other
```

如果遇到问题, 需要查看详细的日志, 可以将更多的日志打印到控制台, 例如添加 `-f -d -U` 挂载选项将调试日志和 `curl` 日志打印到控制台, 如下:

```bash
sudo qsfs jimbucket1 /mnt/jimbucket1 -z=sh1a -o allow_other -f -d -U
```

对于私有云, 挂载时还需要添加 `-H` 指定 host, 具体可参见 [快速开始](##快速开始)

## 选项列表

| short | full | type | required | usage |
| ----- |------|:------:|:----------:|------ |
| -z | `--zone`        | string  | Y | 指定 Bucket 所在区域 |
| -c | `--credentials` | string  | N | 指定密钥文件路径，默认路径　`/etc/qsfs.cred` |
| -l | `--logdir`      | string  | N | 指定输出日志路径，默认路径 `/tmp/qsfs_log/` |
| -L | `--loglevel`    | string  | N | 指定日志级别 (INFO，WARN，ERROR 或者 FATAL)，默认级别 WARN |
| -F | `--filemode`    | octal   | N | 指定挂载目录下文件的访问权限位，默认 `644` |
| -D | `--dirmode`     | octal   | N | 指定挂载目录下文件夹的访问权限位，默认 `755` |
| -u | `--umaskmp`     | octal   | N | 指定挂载目录的权限屏蔽字 (umask) ，该选项需要同 fuse 选项 allow_other 一起使用, 默认 `0000` |
| -r | `--retries`     | integer | N | 指定请求重试次数 |
| -R | `--reqtimeout`  | integer | N | 指定请求时限 (秒)，默认 `30` 秒 |
| -Z | `--maxcache`    | integer | N | 指定使用内存缓存容量 (MB)，默认 `200MB` |
| -k | `--diskdir`     | string  | N | 指定本地缓存路径，确保内存缓存不足时文件缓存成功，默认路径 `/tmp/qsfs_cache/` |
| -t | `--maxstat`     | integer | N | 指定缓存的元数据最大数量 (K)，默认值 `20 K` |
| -e | `--statexpire`  | integer | N | 指定缓存的元数据失效时限 (分钟)，给定小于零的值则元数据永不失效，默认元数据不失效 |
| -i | `--maxlist`     | integer | N | 指定 ls 操作时的最大文件数量，给定零值则打印出所有文件信息，默认值为零 |
| -y | `--fscap`       | integer | N | 指定文件系统容量 (GB), 默认值 `1 PB` |
| -n | `--numtransfer` | integer | N | 指定文件传输时并行传输数，当需要传输大文件时可以增加该值，默认值 `5` |
| -b | `--bufsize`     | integer | N | 指定文件传输时每单个传输的缓存空间 (MB)，该值必须大于 8MB，默认值 `10 MB` |
| -j | `--prefetchsize`| integer | N | 指定文件预读最大尺寸 (MB), 默认值 `20 MB` |
| -H | `--host`        | string  | N | 指定 host name，默认值 `qingstor.com` |
| -p | `--protocol`    | string  | N | 指定 protocol，默认值 `https` |
| -P | `--port`        | integer | N | 指定 port，默认值 `443` (https) 或 `80` (http) |
| -J | `--prefetch`    | bool    | N | 开启预读 |
| -m | `--contentMD5`  | bool    | N | 开启 MD5 校验保证数据完整性 |
| -K | `--keeplogdir`  | bool    | N | 开启在启动时不清除日志目录 |
| -C | `--nodatacache` | bool    | N | 开启清理文件数据缓存 |
| -f | `--forground`   | bool    | N | 开启前台模式，将日志打印到控制台并开启 FUSE 前台模式 |
| -s | `--single`      | bool    | N | 开启 FUSE 单线程开关 |
| -d | `--debug`       | bool    | N | 开启 debug 模式 |
| -g | `--fusedbg`     | bool    | N | 开启 FUSE debug |
| -U | `--curldbg`     | bool    | N | 开启 curl 日志 |
| -h | `--help`        | bool    | N | 打印 qsfs 帮助 |
| -V | `--version`     | bool    | N | 打印 qsfs 版本 |

你也可以通过 `-o opt [,opt...]` 指定 FUSE 特定的挂载选项比如 nonempty，allow_other 等。 详情请参见 FUSE 文档。

## 帮助

可以通过 -h 参数打印简易帮助文件:

```bash
> qsfs -h
```

## 注意事项及问题

### 1. 局限性

qsfs 通过网络将 QingStor 存储桶挂载到本地目录， 通常不能提供与本地文件系统相当的性能和功能。具体而言有如下局限性：

- 随机或追加写操作都会重写整个文件
- 元数据的操作，比如列取文件目录等，性能较差，主要归因于需要网络访问 QingStor 服务器
- 文件或者文件夹的重命名操作不是原子的
- 多个客户端挂载同一个存储桶时，不支持在多个客户端之间进行协调，依赖用户自行协调。比如多个客户端编辑同一个文件的行为等。
- 不支持硬链接
- 暂不支持元数据修改，如 chmod，chgrp，chown，utimens 等

### 2. 关于挂载参数

qsfs 是基于 FUSE 的文件系统，挂载时可以指定 qsfs 特定的参数，也可指定 FUSE 特定的参数，具体如下：

- qsfs 特定的挂载参数，支持短选项和长选项两种格式，它共有两类，一类需要用户指定值，当挂载时不指定该类参数时，都使用其默认值，例如 `-c` 或 `--credentials` 参数指定密钥文件；另一类不需要指定值，类似开关功能，当挂载时不指定该类参数时，默认都是关闭，当挂载指定该类参数时即打开，例如 `-f` 或 `--forground`，打开前台运行模式，默认关闭。具体参数可以通过 qsfs -h 查看。
- FUSE 特定的挂载参数，它是以 `-o opt` 的形式出现的，比如 `-o allow_other`，具体参见 FUSE 的文档。

> 注意　在指定参数值时参数，等号，值之间不应有空格

### 3. 如何卸载挂载目录？

```bash
> fusermount -u MOUNTPOINT
```

或者

```bash
> umount MOUNTPOINT
```

> 注意
>  若提示 `device is busy`，可打开lazy 选项，即 `fusermount -uqz MOUNTPOINT` 或 `umount -l MOUNTPOINT`

### 4. 挂载时如何设置权限？

qsfs 挂载需要 root 权限，那么默认需要 root 权限访问挂载目录。如果需要允许其它用户访问挂载目录，可以在挂载时指定 `allow_other` 参数，例如：

```bash
> qsfs mybucket /path/to/mountpoint -c=/path/to/cred -o allow_other
```

> 注意  `allow_other` 是赋予其他用户访问挂载目录的权限，并不是目录下的文件

如果添加 `allow_other` 参数后，仍然没有访问权限则可以添加 `filemode` 和 `dirmode` 参数来指定文件和文件夹的访问权限，例如：

```bash
> qsfs mybucket /path/to/mountpoint --filemode=666 --dirmode=777 -o allow_other
```

如果想修改挂载目录的访问权限，可以通过 `umaskmp` 参数来设置，该参数需要同 `allow_other` 一起使用，例如以下挂载参数将挂载目录的访问权限设置为 `770` ：

```bash
> qsfs mybucket /path/to/mountpoint --umaskmp=007 -o allow_other
```

> 注意  默认挂载目录权限是 `700`，加 `allow_other` 参数时挂载目录权限是 `777`，注意这些值都是八进制数

### 5. 如何指定挂载目录属于某个 user/group ？

可以通过指定 FUSE 的挂载参数 `uid` 和 `gid` 来指定，例如指定 `uid` 和 `gid` 为 `1000`：

```bash
> qsfs mybucket /path/to/mountpoint -o uid=1000 -o gid=1000
```

> 注意 `uid` 和 `gid` 都是数字，你可以通过 id 命令来查询具体用户的 `uid` 和 `gid`

### 6. 挂载时遇到错误

- 错误信息 `[qsfs ERROR] Unable to access MOUNTPOINT : Transport endpoint is not connected[path=/mnt/qsfs]`

请先卸载对应的目录，再进行挂载。

- 错误信息 `[qsfs ERROR] Unable to access MOUNTPOINT : No such file or directory[path=/mnt/unexisting]`

请先创建该目录，再进行挂载。

### 7. 挂载时遇到如下错误

```bash
fuse: mountpoint is not empty
fuse: if you are sure this is safe, use the 'nonempty' mount option
[qsfs ERROR] Unable to mount qsfs
```

由于挂载目录非空，使用时存在覆盖本地文件的风险，建议用户挂载至一个空目录使用，或者可以加 `-o nonempty` 选项再次挂载．

### 8. 设置自动开机挂载，执行 `mount -a` 遇到如下错误

```bash
mount: wrong fs type, bad option, bad superblock on s3fs#s3fs-test.domain.com,
       missing codepage or helper program, or other error

       In some cases useful info is found in syslog - try
       dmesg | tail or so.
```

请安装 fuse: `apt-get install fuse` or `yum install fuse`.

### 9. 关于使用 rsync 进行同步的问题

当使用 `rsync -a` 进行同步遇到错误信息 `rsync: mkstemp "<filename>" failed: Function not implemented (38)` 时，是由于 `rsync` 调用 `mkstemp` 生成临时文件并设置其权限为 `0600`，由于 qsfs 暂时不支持 chmod，chown，chgrp 等元数据修改操作，会报以上错误。您可以添加 `--no-perms`，`--no-owner`，`--no-group` 参数来避免以上问题，例如：

```bash
rsync -a --no-perms --no-owner --no-group DIR_PATH MOUNT_POINT
```

由于 `rsync` 至挂载目录时, 默认选项可能会有以下几个步骤:

- 上传数据至随机命名的文件
- 下载该文件到tmp目录
- 重命名tmp目录下的文件
- 再次上传文件数据
- 删除tmp目录下的文件

这会导致 `rsync` 的性能大大降低，如果可能的话可以添加 `--inplace` 参数来提高效率。

另外，由于性能上的损耗较大，推荐采用 [qsctl][qsctl_link] 工具进行同步。

### 10. 关于文件元信息（例如大小）与控制台等所见不一致的问题

基于性能上的考虑，比如列取操作会发送大量查询请求，qsfs 在挂载期间默认元数据的缓存时限不会失效，如果用户通过其它工具 (如控制台，[SDK][sdk_link]，[qsctl][qsctl_link]，[ElasticDrive][elastive_drive_link] 等)对文件进行了修改，那么此期间你通过 qsfs 看到的文件信息就可能没有及时更新。

如果想设置元数据的缓存时限，可以在挂载时添加 `--statexpire` 参数来指定失效时限，例如设定失效时间为 `0` ：

```bash
> qsfs mybucket /path/to/mountpoint --statexpire=0
```

### 11. 关于对文件名为中文编码 GBK 支持

目前不支持文件名为非 utf8 编码的文件上传.

[elastive_drive_link]:https://docs.qingcloud.com/qingstor/developer_tools/local_fs_tools/elastic_drive/
[qsctl_link]: https://docs.qingcloud.com/qingstor/developer_tools/qsctl
[sdk_link]:https://docs.qingcloud.com/qingstor/sdk/


