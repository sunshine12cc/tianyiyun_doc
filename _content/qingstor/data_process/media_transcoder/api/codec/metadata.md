---
---

# 视频元信息

参数列表

| Field Name | Type | Description | Required |
|---|---|---|---|
| output | [Object](qsobject.html) | 青云对象存储object | Yes |
| output.key | string | metadata的输出为文件 | - |
| title | string | 视频标题，长度限制：128 Bytes | No |
| comment | string | 视频注释，长度限制：128 Bytes | No |
| copyright | string | 版权信息：长度限制：128 Bytes | No |
| description | string | 视频描述：长度限制：512 Bytes | No |

```
注：
  1）metadata输出为具体文件，output.key需要为 "文件名"，即不以'/'或'\'结尾
```

举例

```
"tasks": [
  {
    "output": {
      "bucket": "mybucket"
      "key": "/my/output/path/separate_folder/"
    },
    "metadata": {
      "title": "transcoder test",
      "comment": "this is for test",
      "copyright": "Qing Cloud",
      "description": "TRANSCODE TEST INFORMATION"
    },
  }
]
```