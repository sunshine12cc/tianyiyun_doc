---
---

# DescribeReservedContracts

获取预留合约列表。

**Request Parameters**

| Parameter name | Type | Description | Required |
| --- | --- | --- | --- |
| reserved_contracts.n | String | 预留合约 ID | No |
| status | String | 合约状态：active - 有效的，pending - 新建还未支付，cancelled - 取消支付，expired - 已过期，terminated - 已终止 | No |
| search_word | String | 搜索关键词, 支持合约名称 | No |
| offset | Integer | 数据偏移量，默认为0 | No |
| limit | Integer | 返回数据长度，默认为20 | No |

[_公共参数_](../../common/parameters.html#api-common-parameters)

**Response Elements**

| Name | Type | Description |
| --- | --- | --- |
| action | String | 响应动作 |
| reserved_contract_set | Array | JSON 格式的数据列表，每项参数可见下面 [Response Item](#response-item) |
| total_count | Integer | 根据过滤条件得到的总数 |
| ret_code | Integer | 执行成功与否，0 表示成功，其他值则为错误代码 |

**Response Item**

| Name | Type | Description |
| --- | --- | --- |
| contract_id | String | 预留合约 ID |
| status | String | 资源告警状态 |
| description | String | 合约名称 |
| resource_type | String | 合约资源类型，如 instance：主机，volume：硬盘 |
| fee | Integer | 合约金额 |
| auto_renew | Integer | 是否自动续约，1 是自动续约，0 是到期停止 |
| association_mode | String | 合约 |
| resource_limit | Integer | 合约可关联资源数量 |
| create_time | String | 合约创建时间 |
| effect_time | String | 合约生效时间 |
| expire_time | String | 合约到期时间 |
| zone_id | String | 合约所在区域 |
| months | Integer | 合约时长，即月份数 |
| last_applyment | Dict | 合约最新一次申请记录 |

**Example**

_Example Request_:

```
https://api.qingcloud.com/iaas/?action=DescribeReservedContracts
&status=active
&COMMON_PARAMS
```

_Example Response_:

```
{
  "action":"DescribeReservedContractsResponse",
  "total_count":1,
  "reserved_contract_set":[
    {
      "last_applyment":{
        "status":"closed",
        "applyment_type":"new",
        "fee":"3",
        "user_id":"usr-FKLksuUv",
        "description":"",
        "zone_id":"pek3",
        "months":1,
        "applyment_id":"ra-wm086b8l",
        "console_id":"qingcloud",
        "currency":"cny",
        "root_user_id":"usr-FKLksuUv",
        "create_time":"2020-07-22T18:17:06",
        "resource_limit":1,
        "entries":[],
        "remarks":"",
        "status_time":"2020-07-22T18:17:06",
        "resource_type":"volume",
        "contract_id":"rc-p1CeBOTV"
      },
      "auto_renew":1,
      "currency":"cny",
      "create_time":"2020-07-22T10:17:05Z",
      "left_migrate":1,
      "resource_limit":1,
      "fee":"3",
      "user_id":"usr-FKLksuUv",
      "contract_id":"rc-p1CeBOTV",
      "left_upgrade":0,
      "status":"active",
      "association_mode":"manual",
      "effect_time":"2020-07-21T16:00:00Z",
      "description":"",
      "transition_status":"",
      "last_applyment_type":"new",
      "entries":[],
      "expire_time":"2020-08-21T16:00:00Z",
      "zone_id":"pek3",
      "months":1,
      "root_user_id":"usr-FKLksuUv",
      "resource_type":"volume"
    }
  ],
  "ret_code":0
}
```
