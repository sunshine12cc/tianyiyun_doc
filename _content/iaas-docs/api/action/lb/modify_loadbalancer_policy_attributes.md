---
---

# ModifyLoadBalancerPolicyAttributes[¶](#modifyloadbalancerpolicyattributes "永久链接至标题")

修改负载均衡器转发策略的属性。

**Request Parameters**

| Parameter name | Type | Description | Required |
| --- | --- | --- | --- |
| loadbalancer_policy | String | 要修改属性的转发策略ID | Yes |
| loadbalancer_policy_name | String | 转发策略名称 | No |
| operator | String | 转发策略规则间的逻辑关系：”and” 是『与』，”or” 是『或』 | No |
| priority | Integer | 转发策略的优先级,默认是0,可用范围0-99 | No |
| zone | String | 区域 ID，注意要小写 | Yes |

[_公共参数_](../../common/parameters.html#api-common-parameters)

**Response Elements**

| Name | Type | Description |
| --- | --- | --- |
| action | String | 响应动作 |
| ret_code | Integer | 执行成功与否，0 表示成功，其他值则为错误代码 |

**Example**

_Example Request_

```
https://api.qingcloud.com/iaas/?action=ModifyLoadBalancerPolicyAttributes
&loadbalancer_policy=lbp-1234abcd
&operator=and
&COMMON_PARAMS
```

_Example Response_:

```
{
  "action":"ModifyLoadBalancerPolicyAttributesResponse",
  "ret_code":0
}
```
