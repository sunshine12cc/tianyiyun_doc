---
---

# 图片缩放

用于对图片进行缩放

## Request Syntax

```http
GET /<object-name>?image&action=resize:w_<width>,h_<height>,m_<mode> HTTP/1.1
Host: <bucket-name>.pek3a.qingstor.com
Date: <date>
Authorization: <authorization-string>
```

## Request Parameters

| Parameter name | Type | Description | Required |
| - | - | - | - |
| width | int | 缩放后的图片宽度(px)，若没有指定，则按照高度进行等比缩放。 | No |
| height | int | 缩放后的图片高度(px)，若没有指定，则按照宽度进行等比缩放。 | No |
| mode | int | 缩放模式，0 表示固定宽高，缩略填充；1 表示根据宽高自动调节；2 表示按照宽高比为 4:4 进行缩略，若 width 和 height 只设置了其中一个，则按照宽度或者高度等比缩放。默认为 0。| No |

## Request Headers

> [参见公共请求头](../common/common_header.html#请求头字段-request-header)

## Request Elements

没有请求消息体

## Response Headers

> [参见公共响应头](../common/common_header.html#响应头字段-request-header)

## Response Elements

对象实体内容

## Example

### Example Request

```http
GET /myphoto.jpg?image&action=resize:w_300,h_400,m_0 HTTP/1.1
Host: mybucket.pek3a.qingstor.com
Date: Sun, 16 Aug 2015 09:05:00 GMT
Authorization: authorization string
```

### Example Response

```http
HTTP/1.1 200 OK
Server: QingStor
Date: Sun, 16 Aug 2015 09:05:00 GMT
Last-Modified: Fri, 14 Aug 2015 09:10:39 GMT
Content-Type: image/jpeg
Content-Length: 7987
Connection: close
x-qs-request-id: aa08cf7a43f611
[7987 bytes of object data]
```
