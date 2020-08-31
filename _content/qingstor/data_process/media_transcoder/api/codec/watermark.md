---
---


# 视频加水印

视频添加水印，支持添加jpg、png格式非动态图片（动图只取第一帧）

| Field Name | Type | Description | Required |
|---|---|---|---|
| input | [Object](qsobject.html) | 水印输入文件 | Yes |
| coordinate | string | 水印的坐标原点位置：<br>topleft, topright, bottomright, bottomleft,<br> 默认为：topright | No |
| dx | int | 相对于坐标原点的x坐标，向心为正，单位：px | Yes |
| dy | int | 相对于坐标原点的y坐标，向心为正，单位：px | Yes |

举例

```
"tasks": [
  {
    "output": {
      "bucket": "mybucket"
      "key": "/my/input/path/example.ext"
    },
    "watermarks": [
      {
        "input": {  // 该input为watermark图片输入
          "bucket": "wmbucket",
          "key": "img01.jpg"
        },
        "dx": 5,
        "dy": 5,
      },
      {
        "input": {  // 该input为watermark图片输入
          "bucket": "wmbucket",
          "key": "img02.png"
        },
        "coordinate": "bottomright",
        "dx": 10,
        "dy": 10
      }
    ]
  }
]
```
