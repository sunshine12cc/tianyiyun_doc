---
---

# 文字水印

用于对图片增加文字水印

> Known issue:  带透明通道的png图片暂时不能支持处理。

## Request Syntax

```http
GET /<object-name>?image&action=watermark:d_<dpi>,p_<opacity>,t_<text>,c_<color> HTTP/1.1
Host: <bucket-name>.pek3a.qingstor.com
Date: <date>
Authorization: <authorization-string>
```

## Request Parameters

| Parameter name | Type | Description | Required |
| - | - | - | - |
| dpi | int | 水印文字的大小，单位为缇，等于磅的 1/20，不填写则默认为 150 。 | No |
| opacity | float | 水印文字的透明度，有效值为(0, 1]，不填写则默认为 0.25 。 | No |
| text | string | 水印文字内容，需由 base64 编码(不加padding, 即结尾的=)。 | Yes |
| color | string | 水印文字颜色，以 `#` 开头的 16 进制字符串，需由 base64 编码(不加padding, 即结尾的=)，默认为 `#000000` ，参考 [RGB颜色编码表](http://www.rapidtables.com/web/color/RGB_Color.htm) 。| No |

## Request Headers

> [参见公共请求头](../common/common_header.html#请求头字段-request-header)

## Request Elements

没有请求消息体

## Response Headers

> [参见公共响应头](../common/common_header.html#响应头字段-request-header)

## Response Elements

对象实体内容

## Example

### Example Request

```http
GET /myphoto.jpg?image&action=watermark:t_5rC05Y2w5paH5a2X,p_0.5 HTTP/1.1
Host: mybucket.pek3a.qingstor.com
Date: Sun, 16 Aug 2015 09:05:00 GMT
Authorization: authorization string
```

### Example Response

```http
HTTP/1.1 200 OK
Server: QingStor
Date: Sun, 16 Aug 2015 09:05:00 GMT
Last-Modified: Fri, 14 Aug 2015 09:10:39 GMT
Content-Type: image/jpeg
Content-Length: 7987
Connection: close
x-qs-request-id: aa08cf7a43f611
[7987 bytes of object data]
```
