---
---

# DeleteTopologyTemplates[¶](#deletetopologytemplates "永久链接至标题")

删除资源编排模板

**Request Parameters**

| Parameter name | Type | Description | Required |
| --- | --- | --- | --- |
| topology_templates.n | String | 一个或多个模板ID | Yes |

[_公共参数_](../../common/parameters.html#api-common-parameters)

**Response Elements**

| Name | Type | Description |
| --- | --- | --- |
| action | String | 响应动作 |
| topology_templates | Array | 已删除的模板ID列表 |
| ret_code | Integer | 执行成功与否，0 表示成功，其他值则为错误代码 |

**Example**

_Example Request_

```
https://api.qingcloud.com/iaas/?action=DeleteTopologyTemplates
&topology_templates.0=tpt-w8iahdca
&COMMON_PARAMS
```

_Example Response_:

```
{
  "action":"DeleteTopologyTemplatesResponse",
  "topology_templates":[
    "tpt-w8iahdca"
  ],
  "ret_code":0
}
```
