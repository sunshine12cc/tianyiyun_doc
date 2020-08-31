---
---

# 基本图片处理

用于对用户存储于 QingStor 对象存储上的图片进行各种基本处理，例如格式转换，裁剪，翻转，水印等。

目前支持的图片格式及操作如下:

| 操作/格式 | jpeg | png | webp | tiff | gif | svg | pdf |
| [图片信息](info.html) | Y | Y | Y | Y | Y | Y | Y |
| [图片裁剪](crop.html) | Y | Y | Y | Y | N | N | N |
| [图片旋转](rotate.html) | Y | Y | Y | Y | N | N | N |
| [图片缩放](resize.html) | Y | Y | Y | Y | Y | N | N|
| [文字水印](watermark.html) | Y | Y | Y | Y | N | N | N |
| [图片水印](watermark_image.html) | Y | Y | Y | Y | N | N | N |
| [图片格式转换](format.html) | Y | Y | Y | Y | N | N | N |
| [图片另存](save.html) | Y | Y | Y | Y | Y | Y | Y |

> **目前不支持对加密过后的图片进行处理，单张图片最大为 `10M` 。**

## Request Syntax

```http
GET /<object-name>?image&action=<action> HTTP/1.1
Host: <bucket-name>.pek3a.qingstor.com
Date: <date>
Authorization: <authorization-string>
```

- `action` 表示对图片的一组操作。
- `action` 的格式为 `operation:k_v[,k_v][|operation:k_v][,k_v]` 。
- `operation` 表示对图片的基本操作，如 crop, watermark 等。每个 `operation` 后面可以接多个 key value pair 作为参数。
- `k` 为 operation 的 argument key, `v` 为 argument value。
- 多个 `operation` 用分隔符 `|` 连接成为一个 `action` ，其将会顺序对图片进行操作，类似管道。

*### Example Request*

```http
GET /myphoto.jpg?image&action=resize:w_300,h_400|rotate:a_90 HTTP/1.1
Host: mybucket.pek3a.qingstor.com
Date: Sun, 16 Aug 2015 09:05:00 GMT
Authorization: authorization string
```

以上示例将图片按照300*400(px)进行固定宽高的缩略，并翻转 90 度。

**详细图片操作**

- [图片信息](info.html)
- [图片裁剪](crop.html)
- [图片旋转](rotate.html)
- [图片缩放](resize.html)
- [文字水印](watermark.html)
- [图片水印](watermark_image.html)
- [图片格式转换](format.html)
- [图片另存](save.html)
