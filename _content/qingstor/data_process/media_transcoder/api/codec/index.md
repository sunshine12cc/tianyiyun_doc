---
---

# 转码任务

转码任务包含音视频转码, 剪裁, 水印等参数, 以及该任务的输出位置


## 转码格式、编码支持：

| Field Name | Format |
|---|---|
| 视频编码 | h264 |
| 视频格式 | flv，mp4 |
| 音频编码 | mp3, aac, vorbis, flac  |
| 音频格式 | mp3, mp4, flv, flac, ogg |

注： 支持编码格式并不意味着可以互相转换


## 转码任务详情

| Field Name | Type | Description | Required |
|---|---|---|---|
| input | json | 输入任务的[Object](qsobject.html) | Yes |
| output | json | 任务输出的[Object](qsobject.html) | Yes |
| [container](container.html) | json | 格式转换 | No |
| [transcode](transcode.html) | json | 视频、音频转码 | No |
| [clip](clip.html) | json | 视频剪裁 | No |
| [watermarks](watermark.html) | json | 视频加水印 | No |
| [separate](separate.html) | json | 音视频分离 | No |
| [posterizetime](posterizetime.html) | json | 视频抽帧截图 | No |
| [metadata](metadata.html) | json | 编辑视频元信息 | No |
| [protocol](hls.html) | json | 视频协议转换 | No |
