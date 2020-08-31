---
---

# CheckTopology[¶](#checktopology "永久链接至标题")

检查模板的配置是否合法

**Request Parameters**

| Parameter name | Type | Description | Required |
| --- | --- | --- | --- |
| substances | String | 实体配置，抽取的资源列表，或配置的实体列表转换为JSON串，与 CreateTopologyTemplate 相同 | Yes |
| zone | String | 区域，请区分大小写 | Yes |
| verbose | Integer | 是否返回冗长的信息, 若为1, 则返回模板实体信息；若为2，返回抽象信息；若为3返回全部 | No |

[_公共参数_](../../common/parameters.html#api-common-parameters)

**Response Elements**

| Name | Type | Description |
| --- | --- | --- |
| action | String | 响应动作 |
| substance | Array | 实体（如主机、路由器等）信息，包含实体元属性和关联资源信息 |
| abstract | Dict | 资源抽象信息，包括元素列表、关联关系和依赖约束 |
| ret_code | Integer | 执行成功与否，0 表示成功，其他值则为错误代码 |

**Example**

_Example Request_

```
https://api.qingcloud.com/iaas/?action=CheckTopology
&substances=%5B%22rtr-yosgjbzh%22%5D
&COMMON_PARAMS
```

_Example Response_:

```
{
  "action": "CheckTopologyResponse",
  "topology_templates": null,
  "abstract": {
    "element": [
      {
        "Category": "security_group",
        "ID": "fc0e7cdc-146d-11e6-8e92-5254cd9e6807",
        "Metadata": {
          "zone": "beta",
          "security_group_rules": [
            {
              "disabled": 0,
              "direction": 0,
              "group_id": "sg-ju9zfria",
              "protocol": "icmp",
              "group_rule_id": "sgr-2n5xp19s",
              "priority": 1,
              "action": "accept",
              "val3": "",
              "val2": "0",
              "val1": "8",
              "security_group_rule_name": ""
            },
            {
              "disabled": 0,
              "direction": 0,
              "group_id": "sg-ju9zfria",
              "protocol": "tcp",
              "group_rule_id": "sgr-jkb10voo",
              "priority": 2,
              "action": "accept",
              "val3": "",
              "val2": "22",
              "val1": "22",
              "security_group_rule_name": ""
            }
          ],
          "group_name": "default security group",
          "is_default": 1,
          "group_id": "sg-ju9zfria",
          "ID": "fc0e7cdc-146d-11e6-8e92-5254cd9e6807"
        }
      },
      {
        "Category": "router",
        "ID": "fc0d2d6e-146d-11e6-8e92-5254cd9e6807",
        "Substance": "rtr-yosgjbzh",
        "Options": {
          "router_vxnet": [
            {
              "router_id": "rtr-yosgjbzh",
              "manager_ip": "192.168.100.1",
              "ip_network": "192.168.100.0/24",
              "dyn_ip_end": "192.168.100.254",
              "features": 1,
              "dyn_ip_start": "192.168.100.2",
              "router": "rtr-yosgjbzh",
              "zone": "beta",
              "ID": "fc0e723c-146d-11e6-8e92-5254cd9e6807",
              "vxnet": "vxnet-drjifak",
              "vxnet_id": "vxnet-drjifak"
            }
          ]
        },
        "Metadata": {
          "router_id": "rtr-yosgjbzh",
          "base_vxnet": "",
          "eip_id": "",
          "features": 0,
          "zone": "beta",
          "vpc_id": "",
          "router_type": 1,
          "group_id": "sg-ju9zfria",
          "router_name": "new",
          "ID": "fc0d2d6e-146d-11e6-8e92-5254cd9e6807"
        }
      },
      {
        "Category": "vxnet",
        "ID": "fc0e723c-146d-11e6-8e92-5254cd9e6807",
        "Metadata": {
          "ip_network": "192.168.100.0/24",
          "vxnet_type": 1,
          "vxnet_id": "vxnet-drjifak",
          "zone": "beta",
          "vxnet_name": "new",
          "vpc_router_id": "",
          "ID": "fc0e723c-146d-11e6-8e92-5254cd9e6807"
        }
      }
    ],
    "relation": {
      "fc0d2d6e-146d-11e6-8e92-5254cd9e6807": [
        "fc0e7cdc-146d-11e6-8e92-5254cd9e6807",
        "fc0e723c-146d-11e6-8e92-5254cd9e6807"
      ]
    },
    "constraint": {
      "router": {
        "fc0d2d6e-146d-11e6-8e92-5254cd9e6807": {
          "vxnet-type-1": {
            "count": 1,
            "Substance": "fc0d2d6e-146d-11e6-8e92-5254cd9e6807",
            "resource": [
              "fc0e723c-146d-11e6-8e92-5254cd9e6807"
            ],
            "ID": "fc0d2d6e-146d-11e6-8e92-5254cd9e6807"
          }
        }
      },
      "vxnet-type-1": {
        "fc0e723c-146d-11e6-8e92-5254cd9e6807": {
          "router": {
            "count": 1,
            "Substance": "fc0d2d6e-146d-11e6-8e92-5254cd9e6807",
            "resource": [
              "fc0d2d6e-146d-11e6-8e92-5254cd9e6807"
            ],
            "essential": true,
            "ID": "fc0e723c-146d-11e6-8e92-5254cd9e6807"
          }
        }
      }
    }
  },
  "substance": [
    {
      "Category": "router",
      "Substance": "rtr-yosgjbzh",
      "ID": "fc0d2d6e-146d-11e6-8e92-5254cd9e6807",
      "Property": {
        "security_group": {
          "sg-ju9zfria": {
            "zone": "beta",
            "security_group_rules": [
              {
                "disabled": 0,
                "direction": 0,
                "group_id": "sg-ju9zfria",
                "protocol": "icmp",
                "group_rule_id": "sgr-2n5xp19s",
                "priority": 1,
                "action": "accept",
                "val3": "",
                "val2": "0",
                "val1": "8",
                "security_group_rule_name": ""
              },
              {
                "disabled": 0,
                "direction": 0,
                "group_id": "sg-ju9zfria",
                "protocol": "tcp",
                "group_rule_id": "sgr-jkb10voo",
                "priority": 2,
                "action": "accept",
                "val3": "",
                "val2": "22",
                "val1": "22",
                "security_group_rule_name": ""
              }
            ],
            "group_name": "default security group",
            "is_default": 1,
            "group_id": "sg-ju9zfria",
            "ID": "fc0e7cdc-146d-11e6-8e92-5254cd9e6807"
          }
        },
        "vxnet": {
          "vxnet-drjifak": {
            "ip_network": "192.168.100.0/24",
            "vxnet_type": 1,
            "vxnet_id": "vxnet-drjifak",
            "zone": "beta",
            "vxnet_name": "new",
            "vpc_router_id": "",
            "ID": "fc0e723c-146d-11e6-8e92-5254cd9e6807"
          }
        }
      },
      "Options": {
        "router_vxnet": [
          {
            "router_id": "rtr-yosgjbzh",
            "manager_ip": "192.168.100.1",
            "ip_network": "192.168.100.0/24",
            "dyn_ip_end": "192.168.100.254",
            "features": 1,
            "dyn_ip_start": "192.168.100.2",
            "router": "rtr-yosgjbzh",
            "zone": "beta",
            "ID": "fc0e723c-146d-11e6-8e92-5254cd9e6807",
            "vxnet": "vxnet-drjifak",
            "vxnet_id": "vxnet-drjifak"
          }
        ]
      },
      "Metadata": {
        "router_id": "rtr-yosgjbzh",
        "base_vxnet": "",
        "eip_id": "",
        "features": 0,
        "zone": "beta",
        "vpc_id": "",
        "router_type": 1,
        "group_id": "sg-ju9zfria",
        "router_name": "new",
        "ID": "fc0d2d6e-146d-11e6-8e92-5254cd9e6807"
      }
    }
  ],
  "ret_code": 0
}
```
