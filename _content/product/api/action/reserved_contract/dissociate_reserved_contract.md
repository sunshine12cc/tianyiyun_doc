---
---

# DissociateReservedContract

将资源从合约中解绑。

**Request Parameters**

| Parameter name | Type | Description | Required |
| --- | --- | --- | --- |
| contract | String | 预留合约 ID | Yes |
| resources | Array | 资源 ID 列表。可一次解绑多个资源。 | Yes |

[_公共参数_](../../common/parameters.html#api-common-parameters)

**Response Elements**

| Name | Type | Description |
| --- | --- | --- |
| action | String | 响应动作 |
| changed | Array | 解绑成功的资源列表。|
| ret_code | Integer | 执行成功与否，0 表示成功，其他值则为错误代码 |

**Example**

_Example Request_:

```
https://api.qingcloud.com/iaas/?action=DissociateReservedContract
&contract=rc-xxxxx
&resources.1=i-xxxxx
&COMMON_PARAMS
```

_Example Response_:

```
{
  "action":"DissociateReservedContractResponse",
  "changed":[
    "i-xxxxx"
  ],
  "ret_code":0
}
```
