---
---

# ResetInstances[¶](#resetinstances "永久链接至标题")

将一台或多台主机的系统盘重置到初始状态。 被重置的主机必须处于运行（ running ）或关闭（ stopped ）状态。

重置只涉及系统盘数据，不包含主机所加载的硬盘。

**Request Parameters**

| Parameter name | Type | Description | Required |
| --- | --- | --- | --- |
| instances.n | String | 一个或多个主机ID | Yes |
| login_mode | String | 指定登录方式。当为 linux 主机时，有效值为 keypair 和 passwd; 当为 windows 主机时，只能选用 passwd 登录方式。<br/>当登录方式为 keypair 时，需要指定 login_keypair 参数；<br/>当登录方式为 passwd 时，需要指定 login_passwd 参数。 | Yes |
| login_keypair | String | 登录密钥ID。 | No |
| login_passwd | String | 登录密码。 | No |
| need_newsid | Integer | 1: 生成新的SID，0: 不生成新的SID, 默认为0；只对Windows类型主机有效。 | No |
| zone | String | 区域 ID，注意要小写 | Yes |

[_公共参数_](../../common/parameters.html#api-common-parameters)

**Response Elements**

| Name | Type | Description |
| --- | --- | --- |
| action | String | 响应动作 |
| job_id | String | 执行任务的 Job ID |
| ret_code | Integer | 执行成功与否，0 表示成功，其他值则为错误代码 |

**Example**

_Example Request_:

```
https://api.qingcloud.com/iaas/?action=ResetInstances
&instances.1=i-rtyv0968
&zone=pek3a
&COMMON_PARAMS
```

_Example Response_:

```
{
  "action":"ResetInstancesResponse",
  "job_id":"j-ybnoeitr",
  "ret_code":0
}
```