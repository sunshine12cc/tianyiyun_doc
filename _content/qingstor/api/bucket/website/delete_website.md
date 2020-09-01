---
private: true
---

# DELETE Bucket Website

删除 Bucket Web Hosting 设置，website 是存储空间的子资源（subresource）， 只有存储空间所有者才能删除。

获取 Web Hosting 设置请参见 [GET Bucket Website](get_website.html#object-storage-api-get-website) 。

设置 Web Hosting 设置请参见 [PUT Bucket Website](put_website.html#object-storage-api-put-website) 。

## Request Syntax

```http
DELETE /?website HTTP/1.1
Host: <bucket-name>.<zone-id>.qingstor.com
Date: <date>
Authorization: <authorization-string>
```

## Request Parameters

没有请求参数

## Request Headers

参见[公共请求头](../../common/common_header.html#请求头字段-request-header)

## Request Body

没有请求消息体

## Status Code

成功则返回 204. 失败的返回码参考[错误码列表](../common/error_code.html)

## Response Headers

参见[公共响应头](../../common/common_header.html#响应头字段-request-header)

## Response Body

正常情况下没有响应消息体, 错误情况下会有返回码对应的 Json 消息, 参考[错误码列表](../common/error_code.html)



## Example

### Example Request

```http
DELETE /?website HTTP/1.1
Host: mybucket.pek3a.qingstor.com
Date: Sun, 16 Aug 2015 09:05:00 GMT
Content-Length: 30
Authorization: authorization string
```

### Example Response

```http
HTTP/1.1 204 NoContent
Server: QingStor
Date: Sun, 16 Aug 2015 09:05:02 GMT
Content-Length: 0
Connection: close
x-qs-request-id: aa08cf7a43f611e5886952542e6ce14b
```
