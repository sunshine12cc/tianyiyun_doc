---
---

# 视频转HLS

参数列表

| Field Name | Type | Description | Required |
|---|---|---|---|
| output | [Object](qsobject.html) | 青云对象存储object | Yes |
| output.key | string | hls的输出为文件夹 | - |
| protocol | json | hls属于protocol 模板 | Yes |
| protocol.hls | json | hls 模板 | Yes |
| hls.prefix | string | m3u8的url前缀，一般为服务器地址、域名等 | No |
| hls.slice | int | ts切片的长度，取值[5, 60] | Yes |
| hls.display | json | 多码率切片配置码率分辨率 | No |
| display.bitrate | int | 视频码率（单位 kbps） | - |
| display.resolution | string | 视频分辨率 如 '1920x1080' | - |

hls应用举例参考附录：[原视频多码率切片](../appendix.html#原视频多码率切片)

```
注：
  1）hls 的output.key为 "文件夹"，必须以'/'或'\'结尾
  2）prefix主要体现在m3u8的文件列表中，如果做点播使用需要设置为对应服务器地址、路径
```

举例
```
"tasks": [
  {
    "output": {
      "bucket": "mybucket"
      "key": "/my/output/path/hls_folder/"
    },
    "protocol": {
      "hls": {
        "prefix": "live.hls.com/mylive/"
        "slice": 5,    // 分片长度，取值[5, 60]，HLS标准协议为5s
        "display": [   // 多码率选项
          {
            "bitrate": 2000,          //  比特率，单位：kbps
            "resolution": "1920x1080" //  分辨率
          },
          {
            "bitrate": 1000,
            "resolution": "1280x720"
          },
          {
            "bitrate": 400,
            "resolution": "720x480"
          }
        ]
      }
    }
  }
]

注：
    转HLS的存储路径为：

    2. 没有display时，为<prefix>/output.key/下
    3. 有display时，main m3u8和ts分片在prefix/output.key/下，
        各个display的m3u8和ts分片在prefix/output.key/bitrate_resolution/下

```
