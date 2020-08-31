---
---

# ModifyTopologyTemplateAttributes[¶](#modifytopologytemplateattributes "永久链接至标题")

修改模板的基本信息

**Request Parameters**

| Parameter name | Type | Description | Required |
| --- | --- | --- | --- |
| topology_template_id | String | 模板ID | Yes |
| topology_template_name | String | 模板名称 | No |
| description | String | 模板描述 | No |

[_公共参数_](../../common/parameters.html#api-common-parameters)

**Response Elements**

| Name | Type | Description |
| --- | --- | --- |
| action | String | 响应动作 |
| topology_template_id | String | 模板ID |
| ret_code | Integer | 执行成功与否，0 表示成功，其他值则为错误代码 |

**Example**

_Example Request_

```
https://api.qingcloud.com/iaas/?action=ModifyTopologyTemplateAttributes
&topology_template_id=tpt-w8iahdca
&topology_template_name=newname
&COMMON_PARAMS
```

_Example Response_:

```
{
  "action":"ModifyTopologyTemplateAttributesResponse",
  "topology_template_id":"tpt-w8iahdca",
  "ret_code":0
}
```
