---
---

# DeleteTopologies[¶](#deletetopologies "永久链接至标题")

删除生成的编排实例

**Request Parameters**

| Parameter name | Type | Description | Required |
| --- | --- | --- | --- |
| topology.n | 实例ID | 一个或多个实例ID | Yes |

[_公共参数_](../../common/parameters.html#api-common-parameters)

**Response Elements**

| Name | Type | Description |
| --- | --- | --- |
| action | String | 响应动作 |
| topology | Array | 已删除的实例ID列表 |
| ret_code | Integer | 执行成功与否，0 表示成功，其他值则为错误代码 |

**Example**

_Example Request_

```
https://api.qingcloud.com/iaas/?action=DeleteTopologies
&topology.0=tp-n9pajgqv
&COMMON_PARAMS
```

_Example Response_:

```
{
  "action":"DeleteTopologiesResponse",
  "ret_code":0,
  "jobs":[
    "j-mxxguuq5"
  ],
  "topology":[
    "tp-n9pajgqv"
  ]
}
```
