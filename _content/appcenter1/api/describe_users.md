---
---

# DescribeUsers[¶](#describeusers "永久链接至标题")

获取当前用户的基本信息

**No Request Parameters**

[_公共参数_](../../product/api/common/parameters.html#api-common-parameters)

**Response Elements**

| Name | Type | Description |
| --- | --- | --- |
| action | String | 响应动作 |
| user_set | Array | JSON 格式的映像数据列表，每项参数可见下面 [Response Item](#response-item) |
| total_count | Integer | 根据过滤条件得到的映像总数 |
| ret_code | Integer | 执行成功与否，0 表示成功，其他值则为错误代码 |

**Response Item**

| Name | Type | Description |
| --- | --- | --- |
| user_id | String | 用户ID |
| user_name | String | 用户名称 |
| notify_email | String | 通知邮件，用于监控告警 |
| email | String | 注册账户的邮箱 |
| user_type | Integer | 账号类型。0 为主账户， 1 为子账户 |
| gravatar_email | String | 头像邮箱 |
| zones | Array | 可用的区域列表 |
| currency | String | 货币类型， 有效值为 cny,hkd,usd |
| company_phone | String | 公司电话 |
| phone | String | 手机号 |
| address | String | 联系地址 |
| lang | String | 用户区域语言，如 “zh-cn” |
| gender | String | 性别 |
| birthday | TimeStamp | 生日 |
| create_time | TimeStamp | 映像创建时间，为UTC时间，格式可参见 [ISO8601](http://www.w3.org/TR/NOTE-datetime). |

**Example**

_Example Request_

```
https://api.qingcloud.com/app/?action=DescribeUsers
&COMMON_PARAMS
```

_Example Response_:

```
{
"action":"DescribeUsersResponse",
"total_count":1,
"user_set":[
  {
    "notify_email":"someone@example.com",
    "user_type":0,
    "gravatar_email":"someone@example.com",
    "zones":[
      "pek3a", "gd2", "ap2a"
    ],
    "currency":"cny",
    "create_time":"2015-01-20T03:33:47Z",
    "company_phone":"",
    "user_id":"usr-quc7J9zx",
    "company_name":"",
    "user_name":"someone",
    "email":"someone@example.com",
    "phone":"13810000000",
    "birthday":null,
    "address":"",
    "lang":"zh-cn",
    "gender":"male"
  }
],
"ret_code":0
}
```
