---
---

# 视频抽帧截图

参数列表

| Field Name | Type | Description | Required |
|---|---|---|---|
| output | [Object](qsobject.html) | 青云对象存储object | Yes |
| output.key | string | posterizetime 的输出为文件夹 | - |
| posterizetime | json | posterizetime 模板 | Yes |
| posterizetime.format | string | 截图格式，支持jpg，png） | Yes |
| posterizetime.interval | int | 抽帧间隔（秒），<br>interval=0表示保存所有帧，<br> 不能与time同时存在 |  No |
| posterizetime.time | int | 在time位置截图一次，不能与interval同时存在，单位：秒 | No |
| posterizetime.resolution | string | 输出图片分辨率，缺省为原分辨率，<br>像素乘积不超过2560x1440，<br>分辨率大于原分辨率没有效果 | No |

posterizetime应用举例参考附录：[视频缩略图](../appendix.html#视频缩略图)

```
注：
  1）posterizetime 的output.key为 "文件夹"，必须以'/'或'\'结尾
```

举例

```
"tasks": [
  {
    "output": {
      "bucket": "mybucket"
      "key": "/my/output/path/pstrztime_folder/"
    },
    "posterizetime": {
      "format": "png",
      "interval": 5
      // "time": 2500
      "resolution": "1920x1080"
    }
  },
]

注：
  视频抽帧截图的output.key为路径前缀，文件最终会存放于：
  output.key/pstrztime/ 目录下，pstrztime为自动添加，不能去掉
  文件名为: "%s_%s-%.8d" % (src_filename, src_filetype, index)

  如：
  原文件（job.input）为file_name.mp4，截图5幅，保存为jpg
  output.key = aaa/bbb/ccc, 则实际存储路径为：
  aaa/bbb/ccc/pstrztime/file_name_mp4-000000001.jpg
  aaa/bbb/ccc/pstrztime/file_name_mp4-000000002.jpg
  aaa/bbb/ccc/pstrztime/file_name_mp4-000000003.jpg
  aaa/bbb/ccc/pstrztime/file_name_mp4-000000004.jpg
  aaa/bbb/ccc/pstrztime/file_name_mp4-000000005.jpg
```
