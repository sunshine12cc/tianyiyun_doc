---
---

# DescribeTopologyTemplates[¶](#describetopologytemplates "永久链接至标题")

获取一个或多个资源编排模板

**Request Parameters**

| Parameter name | Type | Description | Required |
| --- | --- | --- | --- |
| topology_templates.n | String | 模板ID | No |
| topology_template_name | String | 模板名称 | No |
| status.n | String | 模板状态: available, degraded, deleted | No |
| search_word | String | 搜索关键词, 支持模板ID，模板名称 | No |
| verbose | Integer | 是否返回冗长的信息, 若为1, 则返回模板实体信息；若为2，返回抽象信息；若为3返回全部 | No |
| offset | Integer | 数据偏移量, 默认为0 | No |
| limit | Integer | 返回数据长度，默认为20，最大100。若verbose > 0，limit只支持1 | No |

[_公共参数_](../../common/parameters.html#api-common-parameters)

**Response Elements**

| Name | Type | Description |
| --- | --- | --- |
| action | String | 响应动作 |
| topology_template_set | Array | JSON 格式的模板数据列表, 每项参数可见下面 [`Response Item`_](#id2) |
| total_count | Integer | 根据过滤条件得到的模板总数 |
| ret_code | Integer | 执行成功与否，0 表示成功，其他值则为错误代码 |

**Response Item**

| Name | Type | Description |
| --- | --- | --- |
| topology_template_id | String | 模板ID |
| topology_template_name | String | 模板名称 |
| description | String | 模板描述 |
| substances | Array | 实体（如主机、路由器等）信息，包含实体元属性和关联资源信息 |
| abstract | Dict | 模板中资源抽象信息，包括元素列表、关联关系和依赖约束 |
| status | String | 

模板状态, 有效值为available, degraded, deleted

available：可用

degraded： 不可用，但随时可以根据需要修改为可用

deleted：已删除

 |
| create_time | TimeStamp | 模板创建时间, 为UTC时间, 格式可参见 [ISO8601](http://www.w3.org/TR/NOTE-datetime). |
| status_time | TimeStamp | 模板最近一次状态变更时间, 为UTC时间, 格式可参见 [ISO8601](http://www.w3.org/TR/NOTE-datetime). |

**Example**

_Example Request_

```
https://api.qingcloud.com/iaas/?action=DescribeTopologyTemplates
&topology_templates.1=tpt-w8iahdca
&verbose=3
&offset=0
&limit=0
&COMMON_PARAMS
```

_Example Response_:

```
{
  "action": "DescribeTopologyTemplatesResponse",
  "total_count": 1,
  "topology_template_set": [
    {
      "status": "available",
      "description": "",
      "substances": [
        {
          "Category": "router",
          "Substance": "0a8a9230-fb5a-3d5e-e47d-7e85b84249ed",
          "ID": "0a8a9230-fb5a-3d5e-e47d-7e85b84249ed",
          "Property": {
            "vxnet": {
              "eeb1b894-145c-11e6-8e92-5254cd9e6807": {
                "Origin": true,
                "ID": "eeb1b894-145c-11e6-8e92-5254cd9e6807",
                "zone": "beta",
                "vxnet_id": "vxnet-0"
              }
            }
          },
          "Options": {},
          "Metadata": {
            "count": 1,
            "features": 1,
            "action": "CreateRouters",
            "router_type": 1,
            "router_name": "新建路由器 3",
            "ID": "0a8a9230-fb5a-3d5e-e47d-7e85b84249ed"
          }
        }
      ],
      "abstract": {
        "constraint": {
          "router": {
            "0a8a9230-fb5a-3d5e-e47d-7e85b84249ed": {}
          }
        },
        "relation": {
          "0a8a9230-fb5a-3d5e-e47d-7e85b84249ed": [
            "eeb1b894-145c-11e6-8e92-5254cd9e6807"
          ]
        },
        "element": [
          {
            "Category": "router",
            "Substance": "0a8a9230-fb5a-3d5e-e47d-7e85b84249ed",
            "ID": "0a8a9230-fb5a-3d5e-e47d-7e85b84249ed",
            "Property": {
              "vxnet": {
                "eeb1b894-145c-11e6-8e92-5254cd9e6807": {
                  "Origin": true,
                  "ID": "eeb1b894-145c-11e6-8e92-5254cd9e6807",
                  "zone": "beta",
                  "vxnet_id": "vxnet-0"
                }
              }
            },
            "Options": {},
            "Metadata": {
              "count": 1,
              "features": 1,
              "action": "CreateRouters",
              "router_type": 1,
              "router_name": "新建路由器 3",
              "ID": "0a8a9230-fb5a-3d5e-e47d-7e85b84249ed"
            }
          },
          {
            "Category": "vxnet",
            "ID": "eeb1b894-145c-11e6-8e92-5254cd9e6807",
            "Metadata": {
              "Origin": true,
              "ID": "eeb1b894-145c-11e6-8e92-5254cd9e6807",
              "zone": "beta",
              "vxnet_id": "vxnet-0"
            }
          }
        ]
      },
      "topology_template_name": "",
      "feature": 0,
      "source": "beta",
      "create_time": "2016-05-07T14:06:45Z",
      "owner": "usr-QJ29ZUcq",
      "status_time": "2016-05-07T14:06:45Z",
      "topology_template_id": "tpt-eyy07reo"
    }
  ],
  "ret_code": 0
}
```
