---
---

# 错误码[¶](#common-error-code "永久链接至标题")

当请求发生错误时，服务器会返回错误码 ( ret_code ) 和错误信息 ( message )，完整的错误码如下表。

错误分为 **客户端错误** 和 **服务器端错误** 两种，如果是客户端错误，说明该错误是由用户提交的API引起的；如果是服务器端错误，说明该错误是由服务器端引起的。

**客户端错误**:

| 错误代码 | 错误类型 | 提示 |
| --- | --- | --- |
| 1100 | 消息格式错误 | 当缺少必要参数，或者参数值格式不正确时，会返回该错误。此时可以查看相关文档确认每个参数的格式是否正确。 |
| 1200 | 身份验证失败 |

当用户提供了不存在的access_key_id参数，或者API请求的签名不正确时，会返回该错误。

此时可以检查access_key_id和secret_access_key是否配置正确，或者参考我们的签名文档 [_签名方法_](signature.html#common-signature) 检查是否签名有误。

 |
| 1300 | 消息已过期 | 当用户提交的 time_stamp 参数时间过期(超过60秒)时会返回该错误。关于 time_stamp ，可以参考 [_公共参数_](parameters.html#api-common-parameters) |
| 1400 | 访问被拒绝 |

当用户试图访问不属于自己的资源，或者对于提交的操作没有权限，或者试图更改的资源处于不可更改的状态时等，会返回该错误。

我们会在返回的错误信息里头提及错误原因。

 |
| 2100 | 找不到资源 | 当用户试图访问不存在的资源时，会返回该错误。 |
| 2400 | 余额不足 | 当用户余额不足时，会返回该错误。 |
| 2500 | 超过配额 |

当用户试图创建的资源超过用户配额，或者短时间内的API访问请求超过配额限制，会返回该错误。

您可以通过提交工单的方式来向我们申请提高配额，并说明你申请的理由。

 |

**服务器端错误**:

| 错误代码 | 错误类型 | 提示 |
| --- | --- | --- |
| 5000 | 内部错误 | 当服务器执行请求过程中，遇到未知错误时，会返回该错误信息。遇到这种错误，请及时与我们联系。 |
| 5100 | 服务器繁忙 | 当服务器执行超时，或者服务器负载过高无法完成请求时，会返回该错误信息。遇到这种错误，请稍后再尝试，或者及时与我们联系。 |
| 5200 | 资源不足 | 当我们后台计算资源不足以满足用户的创建需求时，会返回该错误信息。遇到这种错误，请及时与我们联系。 |
| 5300 | 服务更新中 | 当我们的后台服务正在更新时，可能会返回该错误信息。遇到这种错误，请稍后再尝试，或者及时与我们联系。 |

**错误样例**:

出现错误时，我们会返回错误码和详细的错误提示:

```
{
  "message":"PermissionDenied, instance [i-2aypaijz] is not running, can not be stopped",
  "ret_code":1400
}
```