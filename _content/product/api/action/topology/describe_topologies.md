---
---

# DescribeTopologies[¶](#describetopologies "永久链接至标题")

获取一个或多个资源编排实例

**Request Parameters**

| Parameter name | Type | Description | Required |
| --- | --- | --- | --- |
| topology.n | String | 一个或多个实例ID | No |
| topology_template_id | String | 模板ID | No |
| topology_name | String | 实例名称 | No |
| status.n | String | 实例状态: 支持pending, creating, ceasing, failed, successful, ceased, done with failure | No |
| search_word | String | 搜索关键词, 支持实例ID，实例名称 | No |
| verbose | Integer | 是否返回冗长的信息, 若为1, 则返回模板实体信息 | No |
| offset | Integer | 数据偏移量, 默认为0 | No |
| limit | Integer | 返回数据长度，默认为20，最大100。若verbose > 0，limit只支持1 | No |

[_公共参数_](../../common/parameters.html#api-common-parameters)

**Response Elements**

| Name | Type | Description |
| --- | --- | --- |
| action | String | 响应动作 |
| topology_set | Array | JSON 格式的实例数据列表, 每项参数可见下面 [`Response Item`_](#id2) |
| total_count | Integer | 根据过滤条件得到的实例总数 |
| ret_code | Integer | 执行成功与否，0 表示成功，其他值则为错误代码 |

**Response Item**

| Name | Type | Description |
| --- | --- | --- |
| topology_id | String | 实例ID |
| topology_template_id | String | 模板ID |
| topology_name | String | 实例名称 |
| description | String | 模板描述 |
| substances | Array | 实体（如主机、路由器等）信息，包含实体元属性和关联资源信息，以及生成资源的id |
| status | String | 

模板状态, 有效值为pending, creating, ceasing, failed, successful, ceased, done with failure

pending：等待中

creating：创建中

ceasing：删除中

failed：编排失败

successful：编排成功

ceased：已删除

done with failure：编排成功，过程中包含非关键失败

 |
| create_time | TimeStamp | 模板创建时间, 为UTC时间, 格式可参见 [ISO8601](http://www.w3.org/TR/NOTE-datetime). |
| status_time | TimeStamp | 模板最近一次状态变更时间, 为UTC时间, 格式可参见 [ISO8601](http://www.w3.org/TR/NOTE-datetime). |

**Example**

_Example Request_

```
https://api.qingcloud.com/iaas/?action=DescribeTopologies
&topology.1=tp-r7yqr7mp
&verbose=1
&offset=0
&limit=0
&COMMON_PARAMS
```

_Example Response_:

```
{
  "action": "DescribeTopologiesResponse",
  "total_count": 1,
  "topology_set": [
    {
      "status": "failed",
      "topology_name": "new db",
      "substance": [
      {
        "Category": "router",
        "Substance": "rtr-5613y7a1",
        "Options": {
          "router_static": {},
          "router_vxnet": [
            {
              "router_id": "rtr-dhudx9kf",
              "manager_ip": "192.168.201.1",
              "ip_network": "192.168.201.0/24",
              "dyn_ip_end": "192.168.201.254",
              "features": 1,
              "dyn_ip_start": "192.168.201.2",
              "create_time": "2016-03-03T17:39:22",
              "vxnet_id": "vxnet-05r97x6"
            }
          ]
        },
        "Property": {
          "security_group": {
            "ae1574e0-deee-11e5-8e92-5254cd9e6807": {
              "is_applied": 1,
              "description": null,
              "group_name": "new db",
              "is_default": 0,
              "create_time": "2016-03-03T17:38:42",
              "ID": "ae1574e0-deee-11e5-8e92-5254cd9e6807",
              "group_id": "sg-boo35o0w",
              "Options": [
                {
                  "priority": 1,
                  "direction": 0,
                  "protocol": "icmp",
                  "group_rule_id": "sgr-x132qodz",
                  "disabled": 0,
                  "val3": "",
                  "action": "accept",
                  "val2": "0",
                  "val1": "8",
                  "security_group_rule_name": ""
                },
                {
                  "priority": 2,
                  "direction": 0,
                  "protocol": "tcp",
                  "group_rule_id": "sgr-foh6nx60",
                  "disabled": 0,
                  "val3": "",
                  "action": "accept",
                  "val2": "22",
                  "val1": "22",
                  "security_group_rule_name": ""
                  }
                ]
              }
            },
            "eip": {
              "ae157756-deee-11e5-8e92-5254cd9e6807": {
                "status": "available",
                "eip_group_id": "eipg-00000000",
                "eip_addr": "192.168.7.122",
                "description": null,
                "associate_mode": 0,
                "resource_id": "",
                "need_icp": 0,
                "sub_code": 0,
                "transition_status": "",
                "icp_codes": "",
                "eip_id": "eip-qyg6qxcd",
                "instance_id": "",
                "billing_mode": "bandwidth",
                "bandwidth": 4,
                "create_time": "2016-03-03T17:38:52",
                "eip_name": "new db",
                "status_time": "2016-03-03T17:38:52",
                "ID": "ae157756-deee-11e5-8e92-5254cd9e6807"
              }
            },
            "vxnet": {
              "ae16221e-deee-11e5-8e92-5254cd9e6807": {
                "vxnet_type": 1,
                "Origion": true,
                "vxnet_id": "vxnet-0",
                "ID": "ae16221e-deee-11e5-8e92-5254cd9e6807"
              },
              "ae1541b4-deee-11e5-8e92-5254cd9e6807": {
                "vxnet_type": 1,
                "description": null,
                "vxnet_name": "new db",
                "create_time": "2016-03-03T17:38:52",
                "ID": "ae1541b4-deee-11e5-8e92-5254cd9e6807",
                "vxnet_id": "vxnet-05r97x6"
              }
            }
          },
          "ID": "ae159a42-deee-11e5-8e92-5254cd9e6807",
          "Metadata": {
            "router_id": "rtr-dhudx9kf",
            "status": "active",
            "is_applied": 1,
            "description": null,
            "router_type": 1,
            "sub_code": 0,
            "transition_status": "",
            "status_time": "2016-03-03T17:39:38",
            "create_time": "2016-03-03T17:39:02",
            "vpc_id": "",
            "eip_id": "",
            "group_id": "sg-boo35o0w",
            "router_name": "new db",
            "features": 0
          }
        },
        {
          "Category": "rdb",
          "Substance": "rdb-9dlj9ws7",
          "Options": {},
          "Property": {},
          "ID": "ae15972c-deee-11e5-8e92-5254cd9e6807",
          "Metadata": {}
        }
      ],
      "zone_id": "beta",
      "transition_substance": "",
      "transition_status": "",
      "root_user_id": "usr-QJ29ZUcq",
      "create_time": "2016-03-03T09:38:36Z",
      "owner": "usr-QJ29ZUcq",
      "status_time": "2016-03-03T09:41:35Z",
      "topology_id": "tp-r7yqr7mp",
      "topology_template_id": "tpt-50ifseb6",
      "error_msg": {
        "2016-03-03 17:39:42": [
          "GrowTopology j-0duc0cmo",
          {
            "request": {
              "rdb_password": "p12cHANgepwD",
              "rdb_type": 1,
              "description": "",
              "auto_backup_time": 99,
              "expires": "2016-03-03T09:40:42Z",
              "engine_version": "5.5",
              "storage_size": 10,
              "rdb_name": "new db",
              "rdb_engine": "mysql",
              "action": "CreateRDB",
              "rdb_username": "clouduser",
              "vxnet": "vxnet-05r97x6",
              "sender": "usr-QJ29ZUcq"
            },
            "response": {
              "message": "超过配额",
              "ret_code": 2500
            }
          }
        ],
        "2016-03-03 17:41:35": [
          "GrowTopology",
          {
            "Recycler": [
                "j-0duc0cmo",
                "Successful Perfect"
            ]
          }
        ]
      },
      "description": ""
    }
  ],
  "ret_code": 0
}
```
