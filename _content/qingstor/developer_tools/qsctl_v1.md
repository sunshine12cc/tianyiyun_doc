---
---

# qsctl 文档

qsctl 是青云对象存储服务的高级命令行工具。它提供了更强大的类 UNIX 命令，使管理对象存储的资源变得像管理本地资源一样方便。这些命令包括：cp，ls，mb，mv，rb，rm, sync 和 presign。所有 qsctl 的命令都支持批量操作。

## 安装

qsctl 可以通过 pip 进行安装:

```bash
> pip install qsctl -U
```

如没有安装 virtualenv:

```bash
> sudo pip install qsctl -U
```

在 Windows 上，请使用管理员权限打开命令行窗口，运行以上命令（忽略 sudo ）。

也可以直接下载并运行我们提供的可执行文件：

- Windows 用户 [qsctl-latest.zip](https://pek3a.qingstor.com/releases-qs/qsctl/qsctl-latest-windows.zip)
- Linux [qsctl-latest.tar.gz](https://pek3a.qingstor.com/releases-qs/qsctl/qsctl-latest-linux.tar.gz)
- Mac OS X 用户 [qsctl-latest.tar.gz](https://pek3a.qingstor.com/releases-qs/qsctl/qsctl-latest-darwin.tar.gz)

> 部分 Windows 用户可能出现缺少 dll 文件的错误，根据自己系统下载并安装合适的依赖包即可：

- [64位系统](https://pek3a.qingstor.com/releases-qs/qsctl/vc_redist.x64.exe)
- [32位系统](https://pek3a.qingstor.com/releases-qs/qsctl/vc_redist.x86.exe)

## 快速开始

使用 qsctl 必需有一个配置文件，用来配置你自己的 `access_key_id` 和 `secret_access_key` 。比如:

```yaml
access_key_id: 'ACCESS_KEY_ID_EXAMPLE'
secret_access_key: 'SECRET_ACCESS_KEY_EXAMPLE'
```

access key 可在 [青云控制台](https://console.qingcloud.com/access_keys/) 申请。

配置文件默认放在 `~/.qingstor/config.yaml` ，也可在每次执行命令时以参数 `-c /path/to/config` 方式来指定，例如:

```bash
> qsctl ls qs://mybucket -c '/root/qingstor_config.yaml'
```

> `~/.qingstor/config.yaml` 为 Unix-Like 系统下的配置文件路径，对 Windows 用户而言，配置文件路径为 `%USERPROFILE%\.qingstor\config.yaml`

配置文件同时支持 `host` ， `port` 等参数的配置，只需要添加对应配置项即可，全部的可配置项如下:

```yaml
host: 'qingstor.com'
port: 443
protocol: 'https'
connection_retries: 3
# Valid levels are 'debug', 'info', 'warn', 'error', and 'fatal'.
log_level: 'debug'
```

> qsctl提供了对旧版的 `qs_access_key_id`，`qs_secret_access_key` 参数的兼容，旧版的配置文件可直接使用，其中 `zone` 参数将忽略。在载入配置文件时 `qsctl` 会按照如下顺序进行尝试，一旦读取成功便不再尝试下一个。

- 用户通过 `-c` 参数指定的路径
- ~/.qingstor/config.yaml
- ~/.qingcloud/config.yaml

## 命令列表

qsctl 支持的操作命令

| ls | 列出所有的存储空间，或给定存储空间给定前缀下的所有对象。 |
| cp | 复制本地文件到QingStor存储空间，或复制QingStor对象到本地。 |
| mb | 创建一个新的存储空间。 |
| rb | 删除一个空的存储空间，或强制删除一个非空的存储空间。 |
| mv | 移动本地文件到QingStor存储空间，或移动QingStor对象到本地。 |
| rm | 删除一个QingStor对象或给定前缀下的所有对象。 |
| sync | 在本地目录和QingStor目录之间同步。 |
| presign | 生成指定对象的临时下载链接。 |

## 查看帮助文件

查看 qsctl 的参数和简易教程，可以通过 -h 参数打印出来:

```bash
> qsctl -h
```

查看 qsctl 的详细手册和示例，请运行:

```bash
> qsctl help
```

## 示例

列出存储空间  下的所有对象:

```bash
> qsctl ls qs://mybucket
Directory                          test/
2016-04-03 11:16:04     4 Bytes    test1.txt
2016-04-03 11:16:04     4 Bytes    test2.txt
```

同步 QingStor 目录到本地文件夹:

```bash
> qsctl sync qs://mybucket/test/ test/
File 'test/README.md' written
File 'test/commands.py' written
```
