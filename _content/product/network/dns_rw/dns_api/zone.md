---
---

# CreateZone[¶](#createzone '永久链接至标题')

- 说明：创建zone
- 请求：
- 参数说明：
- 方法以及URI： `POST http://api.routewize.com/v1/zone/`
- 请求数据体：
  
```python
{
    # 要添加的Zone
    'zone_name':  ZONE_NAME
    # zone备注信息
    'remarks': REMARKS
    # 解析线路, 不需要包含默认解析线路,如果使用默认解析线路，可以忽略该参数
    'zone_views': [{'name': 'dx', 'id': 1}, {'name': 'lt', 'id': 2}]
}
```


- 成功响应：
  
HTTP状态码: 204

```python
{
    'code': CODE,    # 状态码
    'message': MESSAGE,   # 额外信息
    # 如果是中文域名,返回的zone_name是punycode转码后的域名
    'zone_name': ZONE_NAME # zone名字
}
```


# DeleteZone[¶](#deletezone '永久链接至标题')

- 说明： 删除zone
- 请求： 
- 参数说明：
- 方法以及URI: `DELETE http://api.routewize.com/v1/zone/<zone_name>`
- 数据体:
  
```python
{
}
```

- 响应:

    `HTTP状态码： 204`

- 数据体
  
成功执行， HTTP状态码： `204`

```python
{
    NULL
}

```

执行错误,消息体如下：

```python
{
    # 错误码
    'code': CODE,
    # additional message
    'message': MESSAGE
}

```

HTTP状态码： `4**`


# UpdateZoneInfo[¶](#updatezoneinfo '永久链接至标题')

- 说明: 更新zone的描述信息
- 请求: 无
- 参数: 无
- 方法以及URI: `POST http://api.routewize.com/v1/zone/info/`
- 数据体:

```python
{
    'zone_name': ZONE_NAME,
    'remarks': REMARKS,
}
```

- 响应: 成功状态码 - 201
- 响应数据体:

```python
{
    'zone_name': ZONE_NAME
}
```


# DescribeZoneTXT[¶](#describezonetxt '永久链接至标题')

- 说明： 获取zone的TXT验证信息
- 请求： 无
- 参数： 无
- 方法以及URI: `GET http://api.routewize.com/v1/zone/txt/`
- 数据体:

```python
{
    'zone_name': ZONE_NAME,
}
```

- 响应： 成功状态码: 200

- 响应数据体(示例):

```python
{
    'zone_name':'1.com.',
    'verify_domain_record': 'qingcloudcheck',
    'user_id': 'usr-nol2zssr',
    'verify_txt_value': '49f1e2a763b99292cd58978130ed3c53',
    'code': 0,
    'message': 'succ'
}
```


# DescribeZoneView[¶](#describezoneview '永久链接至标题')

- 说明： 获取zone的解析线路信息
- 请求： 无
- 参数： 无
- 方法以及URI: `GET http://api.routewize.com/v1/zone/view/`
- 数据体:

```python
{
    'zone_name': ZONE_NAME,
    # 取值为'GET_FULL' 表示所有解析线路， 取值为: 'GET_USING' 表示获取当前已经使用的解析线路
    'action': ACTION
}
```

- 响应： 成功状态码: 200

- 响应数据体(示例):

```python
{
    'zone_name':'1.com.',
    'user_id': 'usr-nol2zssr',
    'zone_views': [
        {'id': 0, 'name': 'default'},
        {'id': 2, 'name': 'cn_tx'},
        {'id': 3, 'name': 'cn_lt'},
        {'id': 4, 'name': 'cn_yd'},
        {'id': 8, 'name': 'hk_tw_mo_overseas'}
        ],
    'code': 0,
    'message': 'succ'
}
```


# UpdateZoneView[¶](#updatezoneview '永久链接至标题')

- 说明： 更新zone的解析线路信息
- 请求： 无
- 参数： 无
- 方法以及URI: `POST http://api.routewize.com/v1/zone/view/`
- 数据体:

```python
{
    zone_name: ZONE_NAME,
    zone_views:[
            {'name': 'cndx', 'id': 20},
            {'name': 'cnlt', 'id': 21},
            {'name': 'cnlt', 'id': 222},
            {'name': 'default', 'id':0}
        ]
}
```

- 响应： 成功状态码- 200

```python
{
    'code': 0,
    'message': 'succ'
}
```

