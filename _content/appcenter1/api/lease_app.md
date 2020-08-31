---
---

# LeaseApp[¶](#leaseapp "永久链接至标题")

开始对应用服务计费

**Request Parameters**

| Parameter name | Type | Description | Required |
| --- | --- | --- | --- |
| service | String | 要计费的应用服务ID | Yes |
| resource | String | 绑定的青云资源ID，当改资源被销毁时会通知app。 | No |
| zone | String | 区域 ID，注意要小写 | Yes |
| access_token | String | 用户授权 | Yes |

[_公共参数_](../../product/api/common/parameters.html#api-common-parameters)

**Response Elements**

| Name | Type | Description |
| --- | --- | --- |
| action | String | 响应动作 |
| appr_id | String | 应用服务计费资源ID |
| ret_code | Integer | 执行成功与否，0 表示成功，其他值则为错误代码 |

**Example**

_Example Request_

```
https://api.qingcloud.com/app/?action=LeaseApp
&service=apps-1234abcd
&resource=eip-1234abcd
&COMMON_PARAMS
```

_Example Response_:

```
{
"action":"LeaseAppResponse",
"appr_id":"appr-hytu9mj1",
"ret_code":0
}
```
