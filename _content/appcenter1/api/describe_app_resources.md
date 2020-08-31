---
---

# DescribeAppResources[¶](#describeappresources "永久链接至标题")

获取计费资源详细信息

**Request Parameters**

| Parameter name | Type | Description | Required |
| --- | --- | --- | --- |
| apprs.n | String | 查询的计费资源 | Yes |
| status.n | String | 计费资源状态: active, suspended, ceased | No |
| offset | Integer | 数据偏移量，默认为0 | No |
| limit | Integer | 返回数据长度，默认为20 | No |
| zone | String | 区域 ID，注意要小写 | Yes |

[_公共参数_](../../product/api/common/parameters.html#api-common-parameters)

**Response Elements**

| Name | Type | Description |
| --- | --- | --- |
| action | String | 响应动作 |
| appr_set | Array | JSON 格式的数据列表，每项参数可见下面 [Response Item](#response-item) |
| ret_code | Integer | 执行成功与否，0 表示成功，其他值则为错误代码 |

**Response Item**

| Name | Type | Description |
| --- | --- | --- |
| appr_id | String | 计费资源ID |
| service_id | String | 计费服务ID |
| app_id | String | 应用ID |
| appr_name | String | 计费名称 |
| owner | String | 服务使用者ID |
| root_user_id | String | 服务使用者主账号ID |
| status | String | 资源状态，有效值为active, suspended, ceased。 |
| create_time | TimeStamp | 映像创建时间，为UTC时间，格式可参见 [ISO8601](http://www.w3.org/TR/NOTE-datetime). |
| status_time | TimeStamp | 映像最近一次状态变更时间，为UTC时间，格式可参见 [ISO8601](http://www.w3.org/TR/NOTE-datetime). |

**Example**

_Example Request_

```
https://api.qingcloud.com/app/?action=DescribeAppResources
&apprs.1=appr-1234abcd
&status.1=active
&COMMON_PARAMS
```

_Example Response_:

```
{
  "action":"DescribeAppResourcesResponse",
  "total_count":1,
  "appr_set":[
    {
      "status":"active",
      "appr_name":"sample app service",
      "resource_id":"eip-1234abcd",
      "appr_id":"appr-1234abcd",
      "app_id":"app-1234abcd",
      "service_id":"apps-1234abcd",
      "owner":"user-1234abcd",
      "root_user_id":"usr-cT9nUFvT",
      "create_time":"2015-03-10T07:17:16Z",
      "status_time":"2015-03-10T07:29:49Z",
    }
  ],
  "ret_code":0
}
```
