---
---

# 图片裁剪

用于对图片进行裁剪

## Request Syntax

指定裁剪的重心以及宽度和高度
```http
GET /<object-name>?image&action=crop:w_<width>,h_<height>,g_<gravity> HTTP/1.1
Host: <bucket-name>.pek3a.qingstor.com
Date: <date>
Authorization: <authorization-string>
```

指定裁剪的起始坐标以及宽度和高度
```http
GET /<object-name>?image&action=crop:w_<width>,h_<height>,l<left>,t_<top> HTTP/1.1
Host: <bucket-name>.pek3a.qingstor.com
Date: <date>
Authorization: <authorization-string>
```

## Request Parameters

| Parameter name | Type | Description | Required |
| - | - | - | - |
| width | int | 裁剪后的图片宽(px)，若为空则默认为图片原始宽度。 | No |
| height | int | 裁剪后的图片高(px)，若为空则默认为图片原始高度。 | No |
| left | int | 裁剪起始横坐标(px)，若为空则默认为 0 。| No |
| top | int | 裁剪起始纵坐标(px)，若为空则默认为 0 。| No |
| gravity | int | 裁剪的重心，0 表示 centre；1 表示 north；2 表示 east；3 表示 south；4 表示 west；5 为 north west；6 为 north east；7 为 south west；8 为 south east; 9 为 auto；默认为 0 。 | No |

> **如果只有 left / top 参数，裁剪图将从起点 (left, top) 到图的结束**
> **参数 left / top, gravity 不能同时指定，否则报 invalid argument 错误**

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
GET /myphoto.jpg?image&action=crop:w_300,h_400,g_0 HTTP/1.1
Host: mybucket.pek3a.qingstor.com
Date: Sun, 16 Aug 2015 09:05:00 GMT
Authorization: authorization string
```

```http
GET /myphoto.jpg?image&action=crop:w_300,h_400,l_0,t_0 HTTP/1.1
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
