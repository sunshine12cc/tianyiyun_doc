---
---

# 音视频转码

具体格式参见：音视频转码举例

音视频转码均只能保持现有质量或由现有质量向较低质量转换


| Filed Name | Type | Description | Required |
|---|---|---|---|
| video | json | [视频转码json块](#视频转码) | No |
| audio | json | [音频转码json块](#音频转码) | No |

## 视频转码

| Field Name | Type | Description | Required |
|---|---|---|---|
| width | int | 视频宽度，单位px，取值范围[144, 7680] | No |
| height | int | 视频高度，单位px， 取值范围[144, 7680] | No |
| bitrate | int | 视频比特率，单位kbps | No |
| fps | int | 帧率，范围[10-120] | No |
|transpose | string | 视频旋转，取值：90、180、270、hflip、vflip | No |

```
注：
  视频转码中，分辨率（长宽），必须同时存在
  长宽应为偶数，若为奇数，则自动取不大于原值的最大偶数
  如：25x37 则会自动转换成 24x36
```

## 音频转码

| Field Name | Type | Description | Required |
|---|---|---|---|
| bitrate | int | 音频比特率，单位kbps | No |
| samplerate | int | 采样率 | No |
| channels | int | 声道数 | No |

```
音频采样率支持：
flv+aac: 96000, 48000, 44100, 32000, 22050, 11025, 8000
flv+mp3: 44100, 22050, 111025
mp4+aac: 96000, 48000, 44100, 32000, 22050, 11025, 8000
mp4+mp3: 48000, 44100, 32000, 22050

注：如果音频采样率不满足，将自动降到所支持的最近一个低采样率
```

举例参见：
<br>[音视频转码举例](../appendix.html#音视频转码举例)
<br>[原视频多码率不切片](../appendix.html#原视频多码率不切片)
