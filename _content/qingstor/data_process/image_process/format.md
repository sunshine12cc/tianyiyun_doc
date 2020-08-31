---
---

# 图片格式转换

用于将原始图片转换为目标格式

## Request Syntax

```http
GET /<object-name>?image&action=format:t_<type> HTTP/1.1
Host: <bucket-name>.pek3a.qingstor.com
Date: <date>
Authorization: <authorization-string>
```

## Request Parameters

| Parameter name | Type | Description | Required |
| - | - | - | - |
| type | string | 转换后的图片格式目标格式，可选的目标格式为 jpeg, png, webp, tiff。 | Yes |

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
GET /myphoto.jpg?image&action=format:t_webp HTTP/1.1
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
Content-Type: image/webp
Content-Length: 7987
Connection: close
x-qs-request-id: aa08cf7a43f611
[7987 bytes of object data]
```
