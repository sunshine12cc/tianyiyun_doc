---
---

# 图片另存

将图片另存到对象存储的某个 Bucket 下，主要为了方便用户保存各种处理后的图片。

Note: 用户必须有对此 Bucket 的写入权限。

Note: 不支持另存到跨区的 Bucket 中。

## Request Syntax

```http
GET /<object-name>?image&action=save:b_<bucket>,k_<key> HTTP/1.1
Host: <bucket-name>.pek3a.qingstor.com
Date: <date>
Authorization: <authorization-string>
```

## Request Parameters

| Parameter name | Type | Description | Required |
| - | - | - | - |
| bucket | String | 另存为的目标 bucket | Yes |
| key | String | 另存为的目标 object 名称 |Yes |

## Request Headers

> [参见公共请求头](https://docs.qingcloud.com/qingstor/api/common/common_header)

## Request Elements

没有请求消息体

## Response Headers

> [参见公共响应头](https://docs.qingcloud.com/qingstor/api/common/common_header#响应头字段-response-header)

## Response Elements

对象实体内容

## Example

### Example Request

```http
GET /myphoto.jpg?image&action=save:b_testbucket,k_testkey HTTP/1.1
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
