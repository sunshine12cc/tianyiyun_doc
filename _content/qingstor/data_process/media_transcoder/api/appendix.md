---
---

# 附录

```
注：
    附录中例子，仅为源站资源转码，并不是指完整最终解决方案，
    如”动态自适应码率“，就是只对原视频进行转码，
    最终实现还需要客户端、各级CDN、流媒体服务器配合完成
```

## 场景举例

  - [原视频多码率切片](#原视频多码率切片)
  - [原视频多码率不切片](#原视频多码率不切片)
  - [视频缩略图](#视频缩略图)



---
## 原视频多码率切片

```
hls多码率切片可以方便制作动态自适应码率
{
  "type": "codec",
  "input": {
    "bucket": "my-bucket",
    "key": "/my/origin/videos/video007-example.mp4"
  },
  "tasks": [
    {
      "output": {
        "bucket": "my-bucket",
        "key": "/my/videos/video007/"
      },
      "protocol": {
        "hls": {
          "prefix": "qingcloud.com/",
          "slice": 5,
          "display": [
            {
              "bitrate": 2000,
              "resolution": "1920x1080"
            },
            {
              "bitrate": 800,
              "resolution": "1280x720"
            },
            {
              "bitrate": 200,
              "resolution": "480x360"
            }
          ]
        }
      }
    }
  ]
}
```

```
模板解释：
将原视频转为多码率切片视频，可用于多码率点播，或动态自适应码率
该模板为codec模板，任务只有一个：protocol.hls
输入：
  my-bucket/videos/video007-example.mp4
输出：
  主m3u8：
  my-bucket/videos/video007/video007-example_mp4.m3u8

  各个码率m3u8与其ts切片目录：
  my-bucket/videos/video007/video007-example_mp4_1920x1080_2000/...
  my-bucket/videos/video007/video007-example_mp4_1920x1080_2000/...
  my-bucket/videos/video007/video007-example_mp4_1920x1080_2000/...

模板配置注意事项：
1) 如果没有display数组，则默认只做hls切片
2）多码率对应路径prefix为output.key，具体文件夹格式固定为：
  "%s_%s_%s_%d" % (filename, filefmt, size, bitrate)
3)主m3u8中，只有各个码率的子切片目录url
5）slice时长不要小于5s
```


---
## 原视频多码率不切片

```
将原视频转为多个码率：1080p30_2000k, 720p30_1200k, 720p25_800k, 360p25_400k
{
  "type": "codec",
  "input": {
    "bucket": "my-bucket",
    "key": "/my/origin/videos/video007-example.mp4"
  },
  "tasks": [
    {
      "output": {
        "bucket": "my-bucket",
        "key": "/videos/video007/video007-example_flv_1080p30_2000k.flv"
      },
      "transcode": {
        "video": {
          "height": 1080,
          "width": 1920,
          "bitrate": 2000,
          "fps": 30
        },
        "audio": {
          "bitrate": 192,
          "samplerate": 44100,
          "channels": 2
        }
      }
    },
    {
      "output": {
        "bucket": "my-bucket",
        "key": "/videos/video007/video007-example_flv_720p30_1200k.flv"
      },
      "transcode": {
        "video": {
          "height": 720,
          "width": 1280,
          "bitrate": 1200,
          "fps": 25
        },
        "audio": {
          "bitrate": 128,
          "samplerate": 44100,
          "channels": 2
        }
      },
    },
    {
      "output": {
        "bucket": "my-bucket",
        "key": "/videos/video007/video007-example_flv_720p25_800k.flv"
      },
      "transcode": {
        "video": {
          "height": 720,
          "width": 1280,
          "bitrate": 800,
          "fps": 25,
          "channels": 2
        },
        "audio": {
          "bitrate": 128,
          "samplerate": 32000,
        }
      },
    },
    {
      "output": {
        "bucket": "my-bucket",
        "key": "/videos/video007/video007-example_flv_360p20_400k.flv"
      },
      "transcode": {
        "video": {
          "height": 360,
          "width": 480,
          "bitrate": 400,
          "fps": 20
        },
        "audio": {
          "bitrate": 96,
          "samplerate": 22050,
          "channels": 2
        }
      }

    },
  ]
}
```

```
模板解释：
将原视频转为多码率多个视频，可用于点播多码率切换或适配不同终端场景
该模板为codec模板，有transcode task，分别对视频码率、帧数、分辨率，音频采样率、码率、声道做了配置
输入：
  my-bucket/my/origin/videos/video007-example.mp4
输出：
  my-bucket/videos/video007/video007-example_flv_1080p30_2000k.flv
  my-bucket/videos/video007/video007-example_flv_720p30_1200k.flv
  my-bucket/videos/video007/video007-example_flv_720p25_800k.flv
  my-bucket/videos/video007/video007-example_flv_360p20_400k.flv
```


---
## 视频缩略图

```
对源视频在第5秒截屏作为视频缩略图
截图分辨率为：原分辨率、720p、360p的缩略图，格式为：jpg
{
  "type": "codec",
  "input": {
    "bucket": "my-bucket",
    "key": "/my/origin/videos/video007-example.mp4"
  },
  "tasks": [
    {
      "output": {
        "bucket": "my-bucket",
        "key": "/my/videos/previews/video007_origin/"
      },
      "posterizetime": {
        "format": "jpg",
        "time": 5
      }
    },
    {
      "output": {
        "bucket": self.config.bucket_out,
        "key": "/my/videos/previews/video007_720p/“
      },
      "posterizetime": {
        "format": "jpg",
        "time": 5,
        "resolution": "1280x720"
      }
    },
    {
      "output": {
        "bucket": self.config.bucket_out,
        "key": "/my/videos/previews/video007_360p/"
      },
      "posterizetime": {
        "format": "jpg",
        "time": 5,
        "resolution": "480x360"
      }
    }
  ]
}
```
```
模板解释：
该模板为一个codec模板，共有三个任务，分别在第5秒截图并存为不同分辨率
输入：my-bucket/my/origin/videos/video007-example.mp4
输出：
  my-bucket/videos/previews/video007_origin/pstrztime/video007_mp4-00000001.jpg
  my-bucket/videos/previews/video007_720p/pstrztime/video007_mp4-00000001.jpg
  my-bucket/videos/previews/video007_360p/pstrztime/video007_mp4-00000001.jpg

模板配置注意事项：
  1）posterizetime输出为文件夹，所以output.key应该以"/"结尾
  1) 截图路径中： .../pstrztime/... 的pstrztime是自动添加的
```
截图语法规则参考：[posterizetime](codec/posterizetime.html)


---
## 转码全任务举例

```
{
  "type": "codec",
  "input": {
    "bucket": "test",
    "key": "obj"
  },
  "tasks": [
    {
      "output": {
        "bucket": "test",
        "key": "obj2"
      },
      "container": {
        "outformat": "flv"
      },
      "transcode": {
        "video": {
          "width": 320,
          "height": 240,
          "bitrate": 1000,
          "fps": 24,
          "transpose": "270"
        },
        "audio": {
          "bitrate": 256,
          "samplerate": 44100,
          "channels": 2
        }
      },
      "clip": {
        "start": 10,
        "end": 20
      },
      "watermarks": [
        {
          "input": {
            "bucket": "test",
            "key": "img"
          },
          "dx": 5,
          "dy": 5
        },
      ],
      "separate": {
        "option": "video-audio"
      },
      "posterizetime": {
        "interval": 20
      },
      "metadata": {
        "title": "transcoder test",
        "comment": "this is for test",
        "copyright": "Qing Cloud",
        "description": "TRANSCODE TEST INFORMATION"
      },
      "protocol": {
        "hls" : {
          "slice": 5,
          "display": [
            {
              "bitrate": 1200,
              "resolution": "1920x1080"
            },
            {
              "bitrate": 800,
              "resolution": "1280x720"
            },
            {
              "bitrate": 600,
              "resolution": "800x600"
            }
          ]
        }
      }
    },
  ]
}
```

## 音视频转码举例

```
{
  "type": "codec",
  "input": {
    "bucket": "test",
    "key": "obj"
  },
  "tasks": [
    {
      "output": {
        "bucket": "test",
        "key": "obj2"
      },
      "transcode": {
        "video": {
          "bitrate": 1200,
          "fps": 29,
          "height": 1080,
          "width": 1920,
          "transpose": "180"
        },
        "audio": {
          "bitrate": 341,
          "samplerate": 44800,
          "channels": 2
        }
      }
    }
  ]
}
```
