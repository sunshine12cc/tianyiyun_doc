---
private: true
---

# PUT Bucket Website

创建或更新 Bucket Web Hosting 设置，website 是存储空间的子资源（subresource）， 只有存储空间所有者才能设置。

使用前需要向 Bucket 绑定用于静态网站托管的域名，可以通过该域名访问 Bucket 中的静态网站内容。 此时访问静态网站域名的根路径，或者访问的路径以 "/" 结尾，将返回索引页面（Index Document）。 若访问发生错误，如对象不存在，将返回错误页面（Error Document）。

例如，设置索引页面的 suffix 为 "index.html"，设置错误页面的 key 为 "error.html"。 访问根路径时，将返回 "index.html"，访问 "about/" 时，将返回 "about/index.html"。 访问 "test/hello.mp4" 时，如果 "test/hello.mp4" 对象不存在，将返回 "error.html"。

获取 Web Hosting 设置请参见 [GET Bucket Website](get_website.html#object-storage-api-get-website) 。

删除 Web Hosting 设置请参见 [DELETE Bucket Website](delete_website.html#object-storage-api-delete-website) 。

## Request Syntax

```http
PUT /?website HTTP/1.1
Host: <bucket-name>.<zone-id>.qingstor.com
Date: <date>
Authorization: <authorization-string>

{
    "index_document": {
        "suffix": "<suffix>"
    },
    "error_document": {
        "key": "<key>"
    }
}
```

## Request Parameters

没有请求参数

## Request Headers

参见[公共请求头](../../common/common_header.html#请求头字段-request-header)

## Request Body

Json 消息体

| Name | Type | Description | Required |
| --- | --- | --- | --- |
| index_document | Dict | 静态网站使用的索引页面（Index Document）的设置。 | Yes |
| suffix | String | 静态网站索引页面的 Object Key 的后缀名。注意，suffix 不需要 "/" 前缀。 | Yes |
| error_document | Dict | 静态网站使用的错误页面（Error Document）的设置。 | Yes |
| key | String | 静态网站错误页面的 Object Key。 | Yes |


## Status Code

正常会返回 200,  失败的返回码参考[错误码列表](../common/error_code.html)

## Response Headers

参见[公共响应头](../../common/common_header.html#响应头字段-request-header)

## Response Body

正常情况下没有响应消息体, 错误情况下会有返回码对应的 Json 消息, 参考[错误码列表](../common/error_code.html)


## Example

### Example Request

```http
PUT /?website HTTP/1.1
Host: mybucket.pek3a.qingstor.com
Date: Sun, 16 Aug 2015 09:05:00 GMT
Content-Length: 30
Authorization: authorization string

{
    "index_document": {
        "suffix": "index.html"
    },
    "error_document": {
        "key": "404.html"
    }
}
```

### Example Response

```http
HTTP/1.1 200 OK
Server: QingStor
Date: Sun, 16 Aug 2015 09:05:02 GMT
Content-Length: 0
Connection: close
x-qs-request-id: aa08cf7a43f611e5886952542e6ce14b
```
