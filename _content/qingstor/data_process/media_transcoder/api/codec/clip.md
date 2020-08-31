---
---

# 音视频裁剪

参数列表

| Field Name | Type | Description | Required |
|---|---|---|---|
| output | [Object](qsobject.html) | 青云对象存储object | Yes |
| output.key | string | clip的输出为文件 | - |
| clip | json | clip 模板 | Yes |
| clip.start | int | 切片起始时间（秒） | Yes |
| clip.end | int | 切片结束时间（秒） |  No |
| clip.duration | int | 切片长度（秒） | No |

```
注：
  1）end和duration不能同时存在
  2）clip输出为具体文件，output.key需要为 "文件名"，即不以'/'或'\'结尾
```

clip任务举例：

```
// start-only: 指定开始时间，截取到视频结束， 单位：秒
"tasks": [
  {
    "output": {
      "bucket": "mybucket"
      "key": "/my/input/path/example.ext"
    },
    "clip": {
      "start": 1500
    }
  }
]

// start-end: 指定开始、结束时间，单位：秒
"tasks": [
  {
    "output": {
      "bucket": "mybucket"
      "key": "/my/input/path/example.ext"
    },
    "clip": {
      "start": 1500,
      "end": 3500
    }
  }
]

// start+duration: 指定开始时间和持续时间，单位秒
"tasks": [
  {
    "output": {
      "bucket": "mybucket"
      "key": "/my/input/path/example.ext"
    },
    "clip": {
      "start": 1500,
      "duration": 3500
    }
  }
]
```
