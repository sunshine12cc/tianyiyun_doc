---
---

# 图片信息

用于获取图片的基本信息和部分 [Exif](https://en.wikipedia.org/wiki/Exif) 信息

## Request Syntax

```http
GET /<object-name>?image&action=info HTTP/1.1
Host: <bucket-name>.pek3a.qingstor.com
Date: <date>
Authorization: <authorization-string>
```

## Request Parameters

没有请求参数

## Request Headers

> [参见公共请求头](../common/common_header.html#请求头字段-request-header)

## Request Elements

没有请求消息体

## Response Headers

> [参见公共响应头](../common/common_header.html#响应头字段-request-header)

## Response Elements

| Name | Type | Description |
| - | - | - |
| width | Integer | 图片宽度(px)。 |
| height | Integer | 图片高度(px)。 |
| type | String | 图片类型 |
| orientation | Integer | 图片的拍摄相机旋转信息。 |
| space | String | 图片的颜色空间。 |
| alpha | bool | 图片是否含有 alpha 通道。 |
| make | String | 制造厂商。 |
| model | String | 相机型号。 |
| datetime | String | 日期和时间。 |
| exifversion | String | Exif版本。 |
| focallength | String | 焦距。 |
| gpslatituderef | String | GPS 纬度参考。 |
| gpslatitude | String | GPS 纬度。 |
| gpslongituderef | String | GPS 经度参考。 |
| gpslongitude | String | GPS 经度。 |
| gpsaltituderef | String | GPS 高度参考。 |
| gpsaltitude | String | GPS 高度。 |

## Example

### Example Request

```http
GET /myphoto.jpg?image&action=info HTTP/1.1
Host: mybucket.pek3a.qingstor.com
Date: Sun, 22 Jul 2018 08:48:30 GMT
Authorization: authorization string
```

### Example Response

```http
HTTP/1.1 200 OK
Server: QingStor
Date: Sun, 22 Jul 2018 08:48:30 GMT
Content-Length: 379
Connection: close
x-qs-request-id: 256f44de00000af1

{
    "width": 4032,
    "height": 3024,
    "orientation": 1,
    "alpha": false,
    "type": "jpeg",
    "space": "srgb",
    "make": "Apple",
    "model": "iPhone SE",
    "datetime": "2018:06:07 18:44:54",
    "exifversion": "Exif Version 2.21",
    "focallength": "83/20",
    "gpslatituderef": "N",
    "gpslatitude": "40/1 0/1 5588/100",
    "gpslongituderef": "E",
    "gpslongitude": "116/1 27/1 3094/100",
    "gpsaltituderef": "Sea level",
    "gpsaltitude": "7132/100"
}
```
