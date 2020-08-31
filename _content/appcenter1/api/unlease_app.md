---
---

# UnLeaseApp[¶](#unleaseapp "永久链接至标题")

停止对应用服务计费

**Request Parameters**

| Parameter name | Type | Description | Required |
| --- | --- | --- | --- |
| resources.n | String | 停止计费的资源，可以是appr_id, service_id, app_id和user_id。如提供了user_id，就是此用户的计费资源，比如，app_id和user_id一起使用时，表示停止对user_id的应用计费，多用于uninstall_app事件处理中。 | Yes |
| zone | String | 区域 ID，注意要小写 | Yes |

[_公共参数_](../../product/api/common/parameters.html#api-common-parameters)

**Response Elements**

| Name | Type | Description |
| --- | --- | --- |
| action | String | 响应动作 |
| apprs | Array | 被停止的应用服务计费资源ID列表 |
| ret_code | Integer | 执行成功与否，0 表示成功，其他值则为错误代码 |

**Example**

_Example Request_

```
https://api.qingcloud.com/app/?action=UnLeaseApp
&resources.1=app-1234abcd
&resources.2=user-1234abcd
&COMMON_PARAMS
```

_Example Response_:

```
{
"action":"UnLeaseAppResponse",
"apprs":[
  "appr-1234abcd",
  "appr-5678qwer"
],
"ret_code":0
}
```
