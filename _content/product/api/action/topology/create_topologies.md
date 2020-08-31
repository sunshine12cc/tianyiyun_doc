---
---

# CreateTopologies[¶](#createtopologies "永久链接至标题")

应用模板，编排资源，生成实例

**Request Parameters**

| Parameter name | Type | Description | Required |
| --- | --- | --- | --- |
| topology_template_id | String | 模板ID | Yes |
| topology_name | String | 编排名称，如果指定名称，创建的资源其名字将继承该名称 | No |
| description | String | 描述信息 | No |
| zone | String | 区域，请区分大小写 | No |
| count | Integer | 创建数量, 默认为1 | No |
| launch_cfg | String | 创建时配置，与 CreateTopologyTemplate 相同的 JSON 格式。若有此值，会合并并覆盖到 topology_template_id 指定的配置中 | No |

[_公共参数_](../../common/parameters.html#api-common-parameters)

**Response Elements**

| Name | Type | Description |
| --- | --- | --- |
| action | String | 响应动作 |
| topologies | Array | 创建的编排ID列表 |
| job_id | String | 执行任务的 Job ID |
| ret_code | Integer | 执行成功与否，0 表示成功，其他值则为错误代码 |

**Example**

_Example Request_

```
https://api.qingcloud.com/iaas/?action=CreateTopologies
&topology_template_id=tpt-w8iahdca
&topology_name=router
&description=router
&zone=pek3a
&COMMON_PARAMS
```

_Example Response_:

```
{
  "action":"CreateTopologiesResponse",
  "topologies":[
    "tp-tpa9gju3"
  ],
  "job_id":"j-mo1sse6r",
  "ret_code":0
}
```
