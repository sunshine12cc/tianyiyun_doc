---
---

# 音视频转码服务简介

* QingCloud 媒体转码服务是提供对存储在 QingStor 对象存储之上的音视频进行 转码计算的服务,
* 用户可使用快捷的 API 将 QingStor 对象存储中的音视频进行转码,
* 并将结果保存到指定的 QingStor Bucket 中.
* 媒体转码服务 API 覆盖了音视频转码, 转HLS, 添加水印, 裁剪等常见转码业务需求.


# 文档目录

- [请求与应答](api/request_response.html)
- [API类型](api)
    - [QueryAPI](api/query/query.html)
    - [CodecAPI](api/codec)
        - [音视频转封装](api/codec/container.html)
        - [音视频转码](api/codec/transcode.html)
        - [音视频裁剪](api/codec/clip.html)
        - [视频加水印](api/codec/watermark.html)
        - [音视频分离](api/codec/separate.html)
        - [视频抽帧截图](api/codec/posterizetime.html)
        - [视频元信息](api/codec/metadata.html)
        - [视频转HLS](api/codec/hls.html)
- [附录](api/appendix.html)
    - [场景举例](api/appendix.html#场景举例)
    - [转码全任务举例](api/appendix.html#转码全任务举例)
    - [音视频转码举例](api/appendix.html#音视频转码举例)


【文档最后修改时间：2018年12月26日14:42】
