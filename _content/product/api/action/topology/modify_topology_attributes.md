---
---

# ModifyTopologyAttributes[¶](#modifytopologyattributes "永久链接至标题")

修改已生成的编排实例内容

**Request Parameters**

| Parameter name | Type | Description | Required |
| --- | --- | --- | --- |
| topology_id | String | 实例ID | Yes |
| topology_name | String | 编排名称 | No |
| description | String | 编排描述 | No |
| transition_substance | String | 变更的实体信息，同 CreateTopologyTemplate 的 JSON 结构 | No |

[_公共参数_](../../common/parameters.html#api-common-parameters)

**Response Elements**

| Name | Type | Description |
| --- | --- | --- |
| action | String | 响应动作 |
| topology_id | String | 实例ID |
| ret_code | Integer | 执行成功与否，0 表示成功，其他值则为错误代码 |

**Example**

_Example Request_

```
https://api.qingcloud.com/iaas/?action=ModifyTopologyAttributes
&topology_id=tp-tpa9gju3
&topology_name=newname
&COMMON_PARAMS
```

_Example Response_:

```
{
  "action":"ModifyTopologyAttributesResponse",
  "topology_id":"tp-tpa9gju3",
  "ret_code":0
}
```
