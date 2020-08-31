---
---


# 音视频转码API


请求提交成功后会返回任务 ID, 用户可使用该 ID 查询任务执行状态.


## 通用请求格式

Field Nanme | Type | Description
---|---|---
Protocol | string | 目前仅支持http
Host | string | transcoder.\<ZONE\>.qingstor.com
Codec Uri | string | [/v1/codec](codec/), 请求 v1 版 编码器
Query Uri | string | [/v1/query](query/query.html) 请求 v1 版 查询器
Method | string | POST
Authorization | string | [青云对象存储签名](https://docs.qingcloud.com/qingstor/api/common/signature.html)
Body | string | json模板，编码：utf-8

## 转码签名

采用[对象存储签名](https://docs.qingcloud.com/qingstor/api/common/signature.html)

需要注意：
<br>转码请求url 使用的是 青云对象存储 `virtual-host` 风格的 url，
<br>即 \<bucket\>.\<zone\>.qingstor.com/\<resource\>,
<br>因为转码的 Host 为：`transcoder`.\<zone\>.qingstor.com，transcoder占用bucket位置，
<br>所以在签名时，Canonicalized Resource 设置`初始字符串`为 `/transcoder`，需要注意。

举例：
```
URL: https://transcoder.pek3b.qingstor.com/v1/codec, // virtual-host风格

HTTP请求：
POST /v1/codec HTTP/1.1
Host: transcoder.pek3b.qingstor.com
Content-Length: 376
Date: Tue, 04 Dec 2018 12:48:48 GMT
Content-type: Application/json
Authorization: <string_signature>
Content-MD5: <body_md5>

则签名字符串为：
sign_str = "%s\n%s\n%s\n%s\n/transcoder%s" % (
            method, cmd5, ctype, date, resource)
sign_str = "POST\n<body_md5>\nApplication/json\nTue, 04 Dec 2018 12:48:48 GMT\n/transcoder/v1/codec"

需要注意：
  url最后的 "/transcoder/v1/codec" 中，"/transcoder" 即为 初始字符串 "/v1/codec"为resource
```


## Body格式

Field Name | Type | Description
---|---|---
type | string | API类型，[codec](codec)或者[query](query/query.html)
input | string | API输入，一般为[对象存储Object](codec/qsobject.html)
tasks | list of json | task列表，为具体操作

**举例**

```
POST /v1/codec HTTP/1.1
Host: transcoder.<ZONE>.qingstor.com
Content-Length: 376
Date: Tue, 04 Dec 2018 12:48:48 CST
Content-type: Application/json
Authorization: <string_signature>
Content-MD5: <string_md5>

{
  "type": "codec",
  "input": {
    "bucket": "inputbucket",
    "key": "example_in.mp4"
  },
  "tasks": [
    {
      "output": {
        "bucket": "outputbucket",
        "key": "example_out.flv"
      },
      "container": {
        "outformat": "flv"
      }
    }
  ]
}

```

## 通用返回格式

Field Name | Type | Description
---|---|---
tasks | json | 成功时返回提交job的taskID列表
message | string | 错误是返回错误原因

**举例**

```
succeeded:
http返回201, body为:
{"tasks": ["ID1", "ID2", "ID3", ..., "IDn"]}

failed:
http返回400, body为:
{"message": "reasons why ..."}
```
