---
---

# 历史变更

QingStor 对象存储是一个不断迭代升级的存储服务，本文档将罗列每次 API 更新的内容。QingStor 对象存储在正式发布以后，所有 API 接口更新都将保证向后兼容。

> **`+` 加号代表新增接口，粗体表示一组接口集合**

| 更新日期 | 内容说明 | 涉及接口 | 备注 |
| --- | --- | --- | --- |
| 2020-05-15 | 开放 雅加达（ap3）区 | - | - |
| 2020-02-23 | 新增 Append Object 接口 | + Append Object | [查阅详情](api/object/append.html) |
| 2019-09-04 | List Buckets 接口支持分页 | Get Service (List Buckets) | [查阅详情](api/service/get.html) |
| 2018-08-01 | 图片处理功能增加部分 Exif 信息支持 | Image - Info | [查阅详情](data_process/image_process/info.html) |
| 2018-08-01 | List Objects (Bucket Get) 接口 增加 "has_more" 标志 | List Objects (Bucket Get) | [查阅详情](api/bucket/get.html) |
| 2018-05-16 | 上线生命周期功能  | Lifecycle | [查阅详情](api/bucket/lifecycle/index.html) |
| 2018-05-16 | 上线低频存储功能，支持 x-qs-storage-class | Object APIs | [查阅详情](api/object/put.html) |
| 2018-03-15 | 发布挂载盘 Qsfs 和 Elastic Drive | - | [查阅详情](developer_tools/index.html) |
| 2017-12-08 | 兼容 AWS S3 v2/v4 参数签名。| S3 v2/v4 parameter authorization. | [查阅详情](https://docs.qingcloud.com/qingstor/s3/) |
| 2017-12-08 | 兼容 S3 Multipart Copy 接口。| S3 Multipart copy | [查阅详情](https://docs.qingcloud.com/qingstor/s3/) |
| 2017-12-03 | 新增自定义元数据功能，以及 Put Object 支持请求头 Cache-Control、Content-Disposition、Content-Encoding、Expires。 兼容S3各接口的元数据功能。 所有返回的 x-qs-* Header 均统一为小写。| **All Object API** | [查阅原生接口](api/common/metadata.html) <br> [查阅S3兼容接口](\https://docs.qingcloud.com/qingstor/s3/) |
| 2017-10-10 | 新增列取 Qinstor 可用区接口 | + List Locations | [查阅详情](api/service/location.html)|
| 2017-08-28 | 兼容 S3 Get Bucket Location 接口 | + S3 Get Bucket Location | [查阅详情](https://docs.qingcloud.com/qingstor/s3/) |
| 2017-07-19 | 新增图片处理功能 | + Image | [查阅详情](data_process/index.html) |
| 2017-06-28 | 新增第三方图片鉴黄功能 | - | [查阅详情](data_process/third_party/tupu_porn.html) |
| 2017-05-30 | 支持分段复制 | + Copy Object Part | [查阅详情](api/object/multipart/copy_multipart.html) |
| 2017-05-02 | 分段上传改进，支持同一个 object 的并行多个上传过程，相互不影响。| Initiate Multipart Upload | - |
| 2017-01-13 | 新增列取 Multipart Uploads 接口 | + List Multipart Uploads | - |
| 2016-12-21 | 新增对象抓取 (fetch) 接口 | PUT Object - Fetch | [查阅详情](api/object/fetch.html) |
| 2016-12-16 | 接口 GET Object 支持设置响应头，此次更新支持设置的响应头有 Expires、Cache-Control、 Content-Type、Content-Language、Content-Encoding、Content-Disposition | GET Object | [查阅详情](api/object/get.html) |
| 2016-11-09 | 新增对象批量删除接口 | + Delete Multiple Objects | - |
| 2016-10-17 | 新增对象移动接口 | Put Object - Move | - |
| 2016-10-17 | 支持对象数据加密 | **All Object APIs** <br> **All Multipart APIs** | [查阅详情](api/common/encryption.html) |
| 2016-09-28 | 新增存储空间外部镜像设置 | + PUT Bucket External Mirror <br> + GET Bucket External Mirror <br> + DELETE Bucket External Mirror | - |
| 2016-09-12 | 新增表单上传 | + POST Object | - |
| 2016-08-15 | 接口 GET Bucket 响应体增加元素 etag | GET Bucket | - |
| 2016-08-15 | 错误返回中，响应体增加元素 request_id | **All Error Responses** | - |
| 2016-08-04 | 新增对象拷贝接口，支持存储空间内和跨存储空间的对象复制操作 | PUT Object - Copy | - |
| 2016-08-04 | 新增存储空间策略设置接口，支持存储策略 | + PUT Bucket Policy <br> + GET Bucket Policy <br> + DELETE Bucket Policy <br> **All Object APIs** <br> **All Multipart APIs** <br> GET Bucket <br> HEAD Bucket <br> GET Bucket Stats | - |
| 2016-08-04 | 新增跨域访问控制 (CORS) 接口，支持用户自定义设置 CORS 策略 | + PUT Bucket Cors <br> + GET Bucket Cors <br> + DELETE Bucket Cors <br> **All Object APIs**  | - |
| 2016-08-04 | 增加错误码 bad_digest，当用户请求头 Content-MD5 与服务端计算不符时返回此错误 |PUT Object <br> Upload Object Part | - |
| 2016-07-15 | 默认文件类型由 application/oct-stream 变更为 application/octet-stream | PUT Object <br> Initiate Multipart | - |
| 2016-07-15 | 接口 List Parts 响应体增加元素 etag | List Parts | - |
| 2016-07-15 | 接口 List Objects 字段名 marker 变更为 next_marker | List Objects | - |
| 2016-07-15 | 请求头 Content-MD5 字段值改为 base64 编码 | PUT object | 兼容期间同时支持 base64 编码或无编码 |
| 2016-06-18 | 兼容 AWS S3 接口 | - | [查阅详情](https://docs.qingcloud.com/qingstor/s3/) |
