---
---


# 任务状态监控API

对用户提交的任务状态进行统计、追踪


## 请求格式

```
Protocol: HTTP/HTTPS (now only http is supported)
URL:      /v1/monitor
METHOD:   GET
BODY:     json, utf-8

body:
{
    "zone": string,          #
    "bucket": string,        #
    "user": string,          # 用户ID
    "start_time": string,    # 查询起始时间："YYYY-MM-DD HH:MM:SS"
    "end_time": string,      # 查询结束时间："YYYY-MM-DD HH:MM:SS"
    "offset": int,           # mysql offset
    "limit": int,            # mysql limit
}
```


## 返回格式

**成功**

```
status code: 200
body:
{
    "records": {
        "new":          int,
        "ready":        int,
        "waiting":      int,
        "canceled":     int,
        "paused":       int,
        "transcoding":  int,
        "finished":     int,
        "failed":       int,
    }
}

注：
1. 返回为目前八种状态和其数量
2. 这些状态在数据库中用数字0-7表示
3. 当某一状态有错误时，数量int=-1
```

**失败**

```
status code: 404
{"status": "failed", "message": "reason why ..."}
```
