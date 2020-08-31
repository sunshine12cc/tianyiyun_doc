---
---

# Object

codec中object就是青云对象存储object


## 输入 Object 参数列表

| Field Name | Type | Description | Required |
|---|---|---|---|
| input | json | object的描述 | Yes |
| bucket | string | 输入文件所在的bucket | Yes |
| key | string | 输入的具体文件，<br>输入object均为文件，<br>所以不能以'/'或'\\'结尾 | Yes |

举例
```
"input": {
  "bucket": "mybucket"
  "key": "/my/input/path/example.ext"
}
```


## 输出 Object 参数列表

| Field Name | Type | Description | Required |
|---|---|---|---|
| output | json | object的描述 | Yes |
| bucket | string | 输出位置、文件所在的bucket | Yes |
| key | string | 转码的输出为 文件 或 文件夹，<br>抽帧、音视频分离、转hls时<br>输出为文件夹，必须 以 '/'或'\\'结尾 | Yes |

举例

```
当操作为clip、container、metadata、transcode、watermar时，
输出为具体文件，key不以'/'或'\'结尾：
"output": {
  "bucket": "mybucket",
  "key": "example.ext"
}

当操作为posterizetime，separate，hls时，
输出为文件夹，key必须以'/'或'\'结尾：
"output": {
  "bucket": "mybucket",   // QingStor 的 Bucket
  "key": "/my/output/path/example_folder/"
}
```
