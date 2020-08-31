---
---

# CreateTopologyTemplate[¶](#createtopologytemplate "永久链接至标题")

创建资源编排模板

**Request Parameters**

| Parameter name | Type | Description | Required |
| --- | --- | --- | --- |
| topology_template_name | String | 模板名称 | No |
| description | String | 描述信息 | No |
| substances | String | 实体配置，抽取的资源列表，或配置的实体列表转换为JSON串 | Yes |

[_公共参数_](../../common/parameters.html#api-common-parameters)

**Response Elements**

| Name | Type | Description |
| --- | --- | --- |
| action | String | 响应动作 |
| topology_template_id | String | 编排模板ID |
| ret_code | Integer | 执行成功与否，0 表示成功，其他值则为错误代码 |

**Example**

_Example Request_

```
https://api.qingcloud.com/iaas/?action=CreateTopologyTemplate
&substances=%5B%7B%22Category%22%3A%22router%22%2C%22ID%22%3A%220a8a9230-fb5a-3d5e-e47d-7e85b84249ed%22%2C%22Metadata%22%3A%7B%22router_name%22%3A%22%E6%96%B0%E5%BB%BA%E8%B7%AF%E7%94%B1%E5%99%A8+3%22%2C%22router_type%22%3A%221%22%2C%22features%22%3A1%2C%22container%22%3Anull%7D%2C%22Options%22%3A%7B%7D%2C%22Property%22%3A%7B%22vxnet%22%3A%7B%22eaa31d1a-3f9c-8bcd-e8c6-0afa9b4be9a2%22%3A%7B%22vxnet_id%22%3A%22vxnet-0%22%2C%22Origin%22%3Atrue%7D%7D%7D%7D%5D
&topology_template_name=router
&description=router
&COMMON_PARAMS
```

_Example Response_:

```
{
  "action":"CreateTopologyTemplateResponse",
  "topology_template_id":"tpt-w8iahdca",
  "ret_code":0
}
```

**substance格式**

substances是JSON化的列表，列表支持以下几种格式。其中配置列表以主机、路由器、负载均衡器等 IaaS 资源以及 Virtual SAN、VNAS、关系型数据库、缓存、MongoDB、各大数据资源等 PaaS 资源为实体，实体信息在Metadata中，与创建资源的 API 参数兼容。关联的资源作为 Property 属性，如私有网络、硬盘、密钥等，其信息直接放到资源中，参数也与与创建资源的 API 参数兼容。配置相关的信息放到 Options 中，如路由器的静态属性、负载均衡器的监听器等。

_资源类型列表_:

```
{
  substances: ['routers', 'instances', 'rdbs']
}
```

_资源id列表_:

```
{
  substances: ['i-w8iahdca', 'rtr-w8iahdc1', 'rdb-w8iahdc2']
}
```

_配置列表_:

```
{
  substances: [
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
  ]
}
```
