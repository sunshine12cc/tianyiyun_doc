---
---

# 查询任务

查询任务主要用来查询用户提交的任务, 如列出任务, 任务状态, 任务暂停, 撤销等操作


## 查询任务请求格式

Field Nanme | Type | Description
---|---|---
Host | string | transcoder.\<ZONE>.qingstor.com
Query Uri | string | /v1/query，请求v1版查询器
Method | string | POST
Authorization | string | [编转码签名](../request_response.html#转码签名)
Body | string | json模板，编码：utf-8

----
### list tasks

列出指定bucket的 指定 类型任务，并返回这些任务的ID，状态，和基本信息

```
POST /v1/query HTTP/1.1
Host: transcoder.<ZONE>.qingstor.com
Content-Length: 276
Date: Tue, 04 Dec 2018 12:48:48 CST
Content-type: Application/json
Authorization: <string_signature>
Content-MD5: <string_md5>

{
  "type": "query"，
  "tasks": [
    {
      "option": "listtask",
      "argument": "ALL",       // "ALL", "codec", "query"
      "status": "ALL",         // "ALL", "0" ~ "7"
      "bucket": "testbucket",  // bucket名称
      "offset": 0
      "limit": 20
    }
  ]
}

```

| Task Items | Values or Type | Description | Required
---|---|---|---
option | "listtask" | 表示这个query是listtask请求 | Yes
argument | "ALL", "codec", "query" | 指定查询任务类型，大小写敏感 | Yes
status | "ALL", "0" ~ "7" | 指定任务的状态 | Yes
bucket | string | 指定任务被操作文件的bucket | Yes
offset | int | 指定从第几个结果开始返回，默认是0，即最开始 | No
limit | int | 指定每次返回结果的个数，默认是10 | No

## 查询任务返回

**listtask返回结果**

```
List Task：
返回内容格式：json list of dict
{
  "records": [
    {
      "id": string,             // Task ID
      "user": string,           // User ID
      "create_time": int64,     // 任务创建时间
      "finished_time": int64,   // 任务完成时间
      "last_update": int64,     // 记录上次更新时间
      "status": int,            // 任务状态
      "message": string,        // 当前通知信息
      "type": string,           // 任务类型
      "bucket": string,
      "zone": string,
      "body" long string        // 任务内容
    },
    {...}
  ]
  "total_count": int          // 当前查询条件下无limit应返回的总数
}

注：
1）返回结果按时间顺序，最新创建的在前
2）当list task返回空时，records=[],total_count=0
```
