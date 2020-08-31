---
---

# AssociateReservedContract

将资源绑定到合约中，绑定后资源将不再收取弹性费用，直到合约失效或从合约解绑。

**Request Parameters**

| Parameter name | Type | Description | Required |
| --- | --- | --- | --- |
| contract | String | 预留合约 ID | Yes |
| resources | Array | 资源 ID 列表。可一次绑定多个资源。 | Yes |

[_公共参数_](../../common/parameters.html#api-common-parameters)

**Response Elements**

| Name | Type | Description |
| --- | --- | --- |
| action | String | 响应动作 |
| success | Array | 绑定成功的资源列表。|
| fail | Array | 绑定失败的资源列表。（可能会有部分资源配置跟合约不符导致绑定失败） |
| ret_code | Integer | 执行成功与否，0 表示成功，其他值则为错误代码 |

**Example**

_Example Request_:

```
https://api.qingcloud.com/iaas/?action=AssociateReservedContract
&contract=rc-xxxxx
&resources.1=i-xxxxx
&zone=pek3a
&COMMON_PARAMS
```

_Example Response_:

```
{
  "action":"AssociateReservedContractResponse",
  "fail":[],
  "success":[
    "i-xxxx"
  ],
  "ret_code":0
}
```
