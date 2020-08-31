---
---

# UpdateTopology[¶](#updatetopology "永久链接至标题")

应用编排实例的修改，更新到资源上

**Request Parameters**

| Parameter name | Type | Description | Required |
| --- | --- | --- | --- |
| topology | String | 实例ID | Yes |

[_公共参数_](../../common/parameters.html#api-common-parameters)

**Response Elements**

| Name | Type | Description |
| --- | --- | --- |
| action | String | 响应动作 |
| topology | String | 更新的实例ID |
| job_id | String | 执行任务的 Job ID |
| ret_code | Integer | 执行成功与否，0 表示成功，其他值则为错误代码 |

**Example**

_Example Request_

```
https://api.qingcloud.com/iaas/?action=UpdateTopology
&topology=tp-tpa9gju3
&COMMON_PARAMS
```

_Example Response_:

```
{
  "action":"UpdateTopologyResponse",
  "ret_code":0,
  "job_id":"j-c0j3lah5",
  "topology":"tp-tpa9gju3"
}
```
