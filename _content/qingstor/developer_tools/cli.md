---
---
# CLI 文档

QingStor 命令行接口 (*Command Line Interface*) 是与青云对象存储服务交互的命令行接口，通过命令行可以完成和使用对象存储 API 一样的操作。QingStor 命令行工具与 QingCloud CLI 集成在一起，安装方法和命令自动补全 [参见 QingCloud CLI](https://docs.qingcloud.com/product/cli/)

## Quick Start

使用 qingcloud-cli 必需一个配置文件，配置你自己的 `qy_access_key_id` 和 `qy_secret_access_key` 以及 `zone` 。比如:

```yaml
qy_access_key_id: 'QINGCLOUDACCESSKEYID'
qy_secret_access_key: 'QINGCLOUDSECRETACCESSKEYEXAMPLE'
zone: 'pek3a'
```

access key 可在 [青云控制台](https://console.qingcloud.com/access_keys/) 申请。zone 是你的资源所在的节点，可在控制台切换节点的地方查看。

QingStor 默认 `endpoint` 是 `qingstor.com` ，如果需要自定义，可以在配置文件增加:

```yaml
endpoint: 'mydomain.com'
```

QingStor 默认 `protocol` 是 `https` ，支持 `http` 和 `https` ，默认 `port` 是 `443` ，如果需要自定义，可以在配置文件增加:

```yaml
protocol: 'https'
port: 443
```

配置文件默认放在 `~/.qingcloud/config.yaml` ，也可在每次执行命令时以参数 `-f /path/to/config` 方式来指定，例如:

```bash
qingcloud qs list-buckets -f '/root/qingcloud_config.yaml'
```

## 输入参数

如果只是输入 qingcloud qs -h 列出所有支持的命令， 每个命令都有帮助文档，可以通过 -h 参数打印出来，如:

```bash
qingcloud qs get-object -h
```

qingcloud-cli 的参数需要 int, string 和 list 类型。list 类型的输入方式是多个值之间以空格分隔。如:

```bash
qingcloud qs set-bucket-acl -b mybucket -A QS_ACL_EVERYONE,READ usr-wmTc0avW,FULL_CONTROL
```

## 命令输出

Command 的返回结果为 JSON 结构。例如 list-objects 的返回结果:

```json
{
  "name": "mybucket",
  "keys": [
    {
      "key": "myphoto.jpg",
      "size": 67540,
      "modified": 1456226022,
      "mime_type": "image/jpeg",
      "created": "2016-02-23T11:13:42.000Z"
    },
    {
      "key": "mynote.txt",
      "size": 11,
      "modified": 1456298679,
      "mime_type": "text/plain",
      "created": "2016-02-24T06:49:23.000Z"
    }
  ],
  "prefix": "",
  "owner": "qingcloud",
  "delimiter": "",
  "limit": 20,
  "marker": "mynote.txt",
  "common_prefixes": []
}
```

## 命令列表

最新版本 CLI 支持的操作命令

### Service

| list-buckets | 获取存储空间列表 |

### Bucket

| create-bucket | 创建存储空间 |
| delete-bucket | 删除存储空间 |
| head-bucket | 检查存储空间是否存在 |
| stats-bucket | 获取存储空间头信息 |
| list-objects | 获取对象列表 |
| get-bucket-acl | 获取存储空间的访问控制规则 |
| set-bucket-acl | 设置存储空间的访问控制规则 |
| list-multipart-uploads | 获取正在进行的分段上传 |

### Object

| create-object | 创建对象 |
| get-object | 获取对象 |
| delete-object | 删除对象 |
| head-object | 获取对象元信息 |
| initiate-multipart | 初始化分段上传 |
| upload-multipart | 上传分段 |
| list-multipart | 获取分段列表 |
| complete-multipart | 结束分段上传 |
| abort-multipart | 取消分段上传 |
