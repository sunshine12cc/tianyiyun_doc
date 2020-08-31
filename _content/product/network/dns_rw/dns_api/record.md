---
---

# CreateRecord[¶](#createrecord '永久链接至标题')

- 说明： 给指定的zone添加record
- 参数说明：
- 方法以及URI: `http://api.routewize.com/v1/record/`
- 数据体

```python
{
    'zone_name': ZONE_NAME,
    'domain_name': DOMAIN_NAME,
    # 整数，默认解析线路：0（全网默认），其余解析线路传对应的ID
    'view_id': VIEW_ID,
    'type': TYPE,
    'ttl': TTL,
    'record':
    [
        {
            'weight': 0, 'values':[
                    {
                        'value': '1.1.1.1',
                        'status': 1
                    },
                    {
                        'value': '2.2.2.2',
                        'status': 1
                    }
                ]
        },
        {
            'weight': 0, 'values':[
                    {
                        'value': '1.1.1.3',
                        'status': 1
                    },
                    {
                        'value': '1.1.1.4',
                        'status': 1
                    }
                ]
        }
    ],
    'mode': MODE_PROPERTY,
    'auto_merge': AUTO_MERGE,
}

```

校验规则：

- 根据产品要求

数据填写要求：

- auto_merge， 取值范围： 1 表示需要不允许自动合并， 2 表示需要自动合并， **且仅在非权重模式下有意义**
- mode, 记录模式， 取值为：1 普通模式， 2 轮询模式， 3 权重模式， 4 智能模式，可参见：[四种解析模式](../dns_mode)
    - 权重模式仅对CNAME和A记录有意义
    - 智能模式仅对A记录有意义
    - 轮询模式，对A记录有意义
    - 普通模式对所有记录类型均有意义，即默认模式
- records， 记录值列表，必须按示例中格式传递，不能缺少任何字段，
    - status状态会被忽略
    - weight只在权重模式下有意义
- status取值范围
    - 1, 开启(enable)
    - 2, 暂停
- group_status取值范围
    - 1, 开启(enable)
    - 2, 暂停

- 响应：

HTTP状态码： 201，创建成功

- 响应数据体：

```python
{
    'code': 0,
    'domain_name': 'jj.1.com.',
    'domain_record_id': 16,
    'msg': 'succ',
    'records': [
      {
        'group_id': 21,
        'group_status': 1,
        'value': [
          {
            'id': 63,
            'status': 1,
            'value': '14.1.1.1'
          },
          {
            'id': 64,
            'status': 1,
            'value': '15.2.2.4'
          }
        ],
        'weight': 0
      }
    ],
    'view_id': 3
  }

```

返回结果说明：

1. 返回group_id为组ID，用于按组暂停解析记录
2. id为记录ID，用于按记录值的唯一标识，将来用于暂停单个解析记录
3. 若记录被自动合并，只返回合并记录的值，不会返回全量记录列表


# DescribeRecordInfoByID[¶](#describerecordinfobyid '永久链接至标题')

- 说明： 根据domain record id获取record的数据
- 请求： 无
- 请求以及URI: `GET http://api.routewize.com/v1/dr_id/[RECORD_ID]`
- 数据体：无

- 响应数据体(示例)：

```python
'body': {
    'code': 0,
    'data': {
      'create_time': '2019-08-21 06:56:29',
      'domain_name': '1.1455.com.',
      'zone_name': '1455.com.',
      'domain_record_id': 937,
      'mode': 1,
      'rd_class': 'IN',
      'rd_type': 'A',
      'record': [
        {
          'data': [
            {
              'record_value_id': 1985,
              'status': 1,
              'value': '141.1.1.2'
            },
            {
              'record_value_id': 1986,
              'status': 1,
              'value': '15.2.2.3'
            }
          ],
          'group_status': 1,
          'record_group_id': 1212,
          'weight': 0
        }
      ],
      'status': 'enabled',
      'ttl': 600,
      'view_id': 0
    },
    'msg': 'succ'
  },
  'status_code': 200
```


# UpdateRecord[¶](#updaterecord '永久链接至标题')

- 说明：更新Record的记录值， 解析线路， TTL， 类型，模式
- 请求： 无
- 参数： 无
- 方法以及URI: `POST http://api.routewize.com/v1/dr_id/<domain_record_id>`
- 数据体：

```python
{
    'domain_name': DOMAIN_NAME,
    'view_id': VIEW,
    'class': CLASS,
    'type': RECORD_TYPE,
    'ttl': TTL,
    'records':
            [
                [
                    {
                        'weight': WEIGHT,
                        'values':[
                            {'value': '1.1.1.1.', 'status': 1},
                            {'value': '1.1.1.2.', 'status': 1},
                            ]
                    }
                ],
                [
                    {
                        'weight': WEIGHT,
                        'values':[
                            {'value': '1.1.1.3.', 'status': 1},
                            {'value': '1.1.1.4.', 'status': 1},
                            ]
                    }
                ]
            ],
    'mode': MODE_NAME
}
```

数据格式说明见 **Create Record**

- 响应：
    - 成功， HTTP状态码 `201`
    - 失败：见响应数据体

- 响应数据体：
  
```python

```


# DeleteRecord[¶](#deleterecord '永久链接至标题')

- 说明：删除域名记录
- 参数说明
- 方法以及URI: `POST http://api.routewize.com/v1/change_record_status/`
- 消息体

```python
{
    'ids':[IDS],
    # 取值为'delete', 'stop', 'enable'
    'action': 'delete',
    # 目前取值为: 'record', 'group', 'value'
    'target':'record'
}
```

- 响应

HTTP状态码: 200
```python

{
  'code': 0,
  'message': 'succ'
}
```


# UpdateRecordStatus[¶](#updaterecordstatus '永久链接至标题')

- 说明：批量暂停和启动域名记录
- 参数说明
- 方法以及URI: `POST http://api.routewize.com/v1/change_record_status/`
- 消息体

```python
{
    'ids':[IDS],
    # 取值为'stop', 'enable'
    'action': ACTION,
    # 目前取值为: 'record'
    'target':'record'
}
```

- 响应

HTTP状态码: 200

```python
{
  'code': 0,
  'message': 'succ'
}

```


# UpdateRecordGroupStatus[¶](#updaterecordgroupstatus '永久链接至标题')

- 说明：记录按组批量暂停和启动域名记录
- 参数说明
- 方法以及URI: `POST http://api.routewize.com/v1/change_record_status/`
- 消息体

```python
{
    'ids':[IDS],
    # 取值为'stop', 'enable', 'delete'
    'action': ACTION,
    # 目前取值为: 'group'
    'target':'group'
}
```

- 响应

HTTP状态码: 200

```python
{
  'code': 0,
  'message': 'succ'
}

```


# UpdateRecordValueStatus[¶](#updaterecordvaluestatus '永久链接至标题')

- 说明：批量暂停和启动域名记录
- 参数说明
- 方法以及URI: `POST http://api.routewize.com/v1/change_record_status/`
- 消息体

```python
{
    'ids':[IDS],
    # 取值为'stop', 'enable'
    'action': ACTION,
    # 目前取值为: 'value'
    'target':'value'
}
```

- 响应

HTTP状态码: 200

```python
{
  'code': 0,
  'message': 'succ'
}

```

