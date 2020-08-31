---
---

# 音视频分离

分离原视频文件中的音频、视频、或者同时分离音视频

| Field Name | Type | Description | Required |
|---|---|---|---|
| option | string | "video-only": 只分离视频 | Yes |
||| "audio-only"：只分离音频 ||
||| "video-audio"：同时分离音视频 |||

参数列表

| Field Name | Type | Description | Required |
|---|---|---|---|
| output | [Object](qsobject.html) | 青云对象存储object | Yes |
| output.key | string | separate的输出为文件夹 | - |
| separate | json | separate 模板 | Yes |
| option | string | 切片起始时间（秒） | Yes |
| option: "video-only" | int | 切片结束时间（秒） |  No |
| option: "audio-only" | int | 切片长度（秒） | No |
| option: "video-audio" | int | 切片长度（秒） | No |

```
注：
  separate 输出为具体文件夹，output.key需要为 "文件夹"，必须以'/'或'\'结尾
```

```
"tasks": [
  {
    "output": {
      "bucket": "mybucket"
      "key": "/my/output/path/separate_folder/"
    },
    "separate": {
      "option": "audio-only"
    }
  }
]

注：音视频分离的output.key为路径前缀，文件最终会存放于：
    output.key/separate/ 目录下，文件名为output.key最后一段+音视频扩展名
```
