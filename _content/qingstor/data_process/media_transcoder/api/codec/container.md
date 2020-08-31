---
---

# 音视频转封装

目前支持封装（格式）

| Field Name | Format |
|---|---|
| 视频格式 | flv，mp4 |
| 音频格式 | mp3, mp4, flv, flac, ogg |

参数列表

| Field Name | Type | Description | Required |
|---|---|---|---|
| output | [Object](qsobject.html) | 青云对象存储object | Yes |
| output.key | string | container的输出为文件 | - |
| container | json | container 模板 | Yes |
| container.outformat | int | 切片起始时间（秒） | Yes |

```
注：
  1）container输出为具体文件，output.key需要为 "文件名"，即不以'/'或'\'结尾
```

举例：
```
格式转换举例：
"tasks": [
  "output": {
      "bucket": "mybucket"
      "key": "/my/input/path/example.ext"
  },
  "container": {
    "outformat": string  // 输出格式
  }
]
```
