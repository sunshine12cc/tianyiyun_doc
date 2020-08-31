---
---

# 图片水印

用于对图片增加图片水印

## Request Syntax

```http
GET /<object-name>?image&action=watermark_image:l_<left>,t_<top>,p_<opacity>,u_<url> HTTP/1.1
Host: <bucket-name>.pek3a.qingstor.com
Date: <date>
Authorization: <authorization-string>
```

## Request Parameters

| Parameter name | Type | Description | Required |
| - | - | - | - |
| left | int | 水印离左边的距离(px)，不填写则默认为 0 。 | No |
| top | int | 水印离上边的距离(px)，不填写则默认为 0 。 | No |
| opacity | float | 水印透明度，有效值为(0, 1]，不填写则默认为 0.25 。| No |
| url | string | 水印图片地址，须由 base64 进行编码(不加padding)。 | Yes |

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
GET /myphoto.jpg?image&action=watermark_image:u_aHR0cHM6Ly9wZWszYS5xaW5nc3Rvci5jb20vaW1nLWRvYy1lZy9xaW5jbG91ZC5wbmc,l_10,t_10,p_2 HTTP/1.1
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
