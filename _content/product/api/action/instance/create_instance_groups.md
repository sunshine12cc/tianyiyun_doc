---
---

# CreateInstanceGroups[¶](#createinstancegroups "永久链接至标题")

创建主机组。

**Request Parameters**

| Parameter name | Type | Description | Required |
| --- | --- | --- | --- |
| relation | String | 主机组关系 | Yes |
| zone | String | 区域 ID，注意要小写 | Yes |

[_公共参数_](../../common/parameters.html#api-common-parameters)

**Response Elements**

| Name | Type | Description |
| --- | --- | --- |
| action | String | 响应动作 |
| instance_groups | Array | 新创建的主机组列表 |
| ret_code | Integer | 执行成功与否，0 表示成功，其他值则为错误代码 |

**Example**

_Example Request_

```
https://api.qingcloud.com/iaas/?action=CreateInstanceGroups
&relation=repel
&zone=gd2
&COMMON_PARAMS
```

_Example Response_:

```
{
  "action":"CreateInstanceGroupsResponse",
  "instance_groups":[
    "ig-c7v8lro1"
  ],
  "ret_code":0
}
```
