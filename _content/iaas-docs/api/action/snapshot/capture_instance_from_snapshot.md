---
---

# CaptureInstanceFromSnapshot[¶](#captureinstancefromsnapshot "永久链接至标题")

将指定备份导出为映像。请注意，此备份点必须为主机的备份点才能导出为映像。

**Request Parameters**

| Parameter name | Type | Description | Required |
| --- | --- | --- | --- |
| snapshot | String | 备份 ID | Yes |
| image_name | String | 映像名称 | No |
| zone | String | 区域 ID，注意要小写 | Yes |

[_公共参数_](../../common/parameters.html#api-common-parameters)

**Response Elements**

| Name | Type | Description |
| --- | --- | --- |
| action | String | 响应动作 |
| job_id | String | Job ID |
| image_id | String | 新的映像 ID |
| ret_code | Integer | 执行成功与否，0 表示成功，其他值则为错误代码 |

**Example**

_Example Request_

```
https://api.qingcloud.com/iaas/?action=CaptureInstanceFromSnapshot
&snapshot=ss-webd026j
&image_name=image_from_snapshot
&zone=gd1
&COMMON_PARAMS
```

_Example Response_:

```
{
  "action":"CaptureInstanceFromSnapshotResponse",
  "image_id":"img-nbgxbejb",
  "job_id":"j-2h1syb70",
  "ret_code":0
}
```
