---
---

# 签名方法[¶](#common-signature "永久链接至标题")

这里介绍API请求中签名 ( signature ) 的生成方法。签名需要你先在控制台创建 [API密钥](https://console.qingcloud.com/access_keys/) ，获得 accesss_key_id 和 secret_access_key，这里我们假设

```
access_key_id = 'QYACCESSKEYIDEXAMPLE'
secret_access_key = 'SECRETACCESSKEY'
```

例如我们的请求参数如下:

```
{
  "count":1,
  "vxnets.1":"vxnet-0",
  "zone":"pek1",
  "instance_type":"small_b",
  "signature_version":1,
  "signature_method":"HmacSHA256",
  "instance_name":"demo",
  "image_id":"centos64x86a",
  "login_mode":"passwd",
  "login_passwd":"QingCloud20130712",
  "version":1,
  "access_key_id":"QYACCESSKEYIDEXAMPLE",
  "action":"RunInstances",
  "time_stamp":"2013-08-27T14:30:10Z"
}
```

注解

你可以使用上述的 AccessKey 和 Request 调试你的代码， 当得到跟后面一致的签名结果后(即表示你的代码是正确的)， 可再换为你自己的 AccessKey 和其他 API 请求。

签名步骤

**1\. 按参数名进行升序排列**

排序后的参数为:

```
{
  "access_key_id":"QYACCESSKEYIDEXAMPLE",
  "action":"RunInstances",
  "count":1,
  "image_id":"centos64x86a",
  "instance_name":"demo",
  "instance_type":"small_b",
  "login_mode":"passwd",
  "login_passwd":"QingCloud20130712",
  "signature_method":"HmacSHA256",
  "signature_version":1,
  "time_stamp":"2013-08-27T14:30:10Z",
  "version":1,
  "vxnets.1":"vxnet-0",
  "zone":"pek1"
}
```

**2\. 对参数名称和参数值进行URL编码**

编码后的请求串为:

```
{
  "access_key_id":"QYACCESSKEYIDEXAMPLE",
  "action":"RunInstances",
  "count":1,
  "image_id":"centos64x86a",
  "instance_name":"demo",
  "instance_type":"small_b",
  "login_mode":"passwd",
  "login_passwd":"QingCloud20130712",
  "signature_method":"HmacSHA256",
  "signature_version":1,
  "time_stamp":"2013-08-27T14%3A30%3A10Z",
  "version":1,
  "vxnets.1":"vxnet-0",
  "zone":"pek1"
}
```

警告

编码时空格要转换成 “%20” , 而不是 “+”

警告

转码部分的字符要用大写，如 ”:” 应转成 “%3A”，而不是 “%3a”

**3\. 构造URL请求**

参数名和参数值之间用 “=” 号连接，参数和参数之间用 “＆” 号连接，构造后的URL请求为

```
access_key_id=QYACCESSKEYIDEXAMPLE&action=RunInstances&count=1&image_id=centos64x86a&instance_name=demo&instance_type=small_b&login_mode=passwd&login_passwd=QingCloud20130712&signature_method=HmacSHA256&signature_version=1&time_stamp=2013-08-27T14%3A30%3A10Z&version=1&vxnets.1=vxnet-0&zone=pek1
```

**4\. 构造被签名串**

被签名串的构造规则为: 被签名串 = HTTP请求方式 + “\n” + uri + “\n” + url 请求串

警告

“\n” 是换行符，不要将 “\” 转义。也就是说，不要用 “\\n” ，有些语言，比如 php 和 ruby ，请用 “\n” , 而不是 ‘\n’

假设 HTTP 请求方法为 GET 请求的uri路径为 “/iaas/” , 则被签名串为

```
GET\n/iaas/\naccess_key_id=QYACCESSKEYIDEXAMPLE&action=RunInstances&count=1&image_id=centos64x86a&instance_name=demo&instance_type=small_b&login_mode=passwd&login_passwd=QingCloud20130712&signature_method=HmacSHA256&signature_version=1&time_stamp=2013-08-27T14%3A30%3A10Z&version=1&vxnets.1=vxnet-0&zone=pek1
```

**5\. 计算签名**

计算被签名串的签名 signature。

*   将API密钥的私钥 ( secret_access_key ) 作为key，生成被签名串的 HMAC-SHA256 或者 HMAC-SHA1 签名，更多信息可参见 [RFC2104](http://www.ietf.org/rfc/rfc2104.txt)

*   将签名进行 Base64 编码

*   将 Base64 编码后的结果进行 URL 编码

    警告

    当 Base64 编码后存在空格时，不要对空格进行 URL 编码，而要直接将空格转为 “+”

以 Python (版本 2.7) 代码为例 (其他语言类似，需要使用 sha256 + base64 编码，最后需要再进行 URL 编码，URL 编码时需要将原有的空格 ” ” 转为 “+”)

```
import base64
import hmac
import urllib
from hashlib import sha256

# 前面生成的被签名串
string_to_sign = 'GET\n/iaas/\naccess_key_id=QYACCESSKEYIDEXAMPLE&action=RunInstances&count=1&image_id=centos64x86a&instance_name=demo&instance_type=small_b&login_mode=passwd&login_passwd=QingCloud20130712&signature_method=HmacSHA256&signature_version=1&time_stamp=2013-08-27T14%3A30%3A10Z&version=1&vxnets.1=vxnet-0&zone=pek1'
h = hmac.new(secret_access_key, digestmod=sha256)
h.update(string_to_sign)
sign = base64.b64encode(h.digest()).strip()
signature = urllib.quote_plus(sign)
```

**6\. 添加签名**

将签名参数附在原有请求串的最后面。 最终的HTTP请求串为(为了查看方便，我们人为地将参数之间用回车分隔开)

```
access_key_id=QYACCESSKEYIDEXAMPLE
&action=RunInstances
&count=1
&image_id=centos64x86a
&instance_name=demo
&instance_type=small_b
&login_mode=passwd
&login_passwd=QingCloud20130712
&signature_method=HmacSHA256
&signature_version=1
&time_stamp=2013-08-27T14%3A30%3A10Z
&version=1
&vxnets.1=vxnet-0
&zone=pek1
&signature=32bseYy39DOlatuewpeuW5vpmW51sD1A%2FJdGynqSpP8%3D
```

完整的请求URL为(为了查看方便，我们人为地将参数之间用回车分隔开)

```
https://api.qingcloud.com/iaas/?access_key_id=QYACCESSKEYIDEXAMPLE
&action=RunInstances
&count=1
&image_id=centos64x86a
&instance_name=demo
&instance_type=small_b
&login_mode=passwd
&login_passwd=QingCloud20130712
&signature_method=HmacSHA256
&signature_version=1
&time_stamp=2013-08-27T14%3A30%3A10Z
&version=1
&vxnets.1=vxnet-0
&zone=pek1
&signature=32bseYy39DOlatuewpeuW5vpmW51sD1A%2FJdGynqSpP8%3D
```

实际URL为

```
https://api.qingcloud.com/iaas/?access_key_id=QYACCESSKEYIDEXAMPLE&action=RunInstances&count=1&image_id=centos64x86a&instance_name=demo&instance_type=small_b&login_mode=passwd&login_passwd=QingCloud20130712&signature_method=HmacSHA256&signature_version=1&time_stamp=2013-08-27T14%3A30%3A10Z&version=1&vxnets.1=vxnet-0&zone=pek1&signature=32bseYy39DOlatuewpeuW5vpmW51sD1A%2FJdGynqSpP8%3D
```
