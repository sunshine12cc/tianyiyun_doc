---
---

# GET Bucket External Mirror

获取存储空间的外部镜像源站(external mirror source site)，external mirror source site 只有存储空间的所有者才能获取。

设置 external mirror source site 请参见 [PUT Bucket External Mirror](put_external_mirror.html#object-storage-api-put-bucket-external-mirror) 。

删除 external mirror source site 请参见 [DELETE Bucket External Mirror](delete_external_mirror.html#object-storage-api-delete-bucket-external-mirror) 。

## Request Syntax

```http
GET /?mirror HTTP/1.1
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

## Response Headers

参见[公共响应头](../../common/common_header.html#响应头字段-request-header)

## Response Body

| Name | Type | Description |
| --- | --- | --- |
| source_site | String | 外部镜像回源的源站。源站形式为 `<protocol>://<host>[:port]/[path]`。 |

## Example

### Example Request

```http
GET /?mirror HTTP/1.1
Host: mybucket.pek3a.qingstor.com
Date: Sun, 14 Aug 2016 09:05:00 GMT
Authorization: authorization string
```

### Example Response

```http
HTTP/1.1 200 OK
Server: QingStor
Date: Sun, 14 Aug 2016 09:05:01 GMT
Content-Length: 0
Connection: close
x-qs-request-id: aa08cf7a43f611e5886952542e6ce14b

{
    "source_site": "http://example.com/image/"
}
```
