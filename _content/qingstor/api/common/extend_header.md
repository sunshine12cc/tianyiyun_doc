---
---
# 扩展字段

这里列出扩展的 HTTP 头字段

## 请求头字段 (Request Header)

| Header Name | Description |
| --- | --- |
| x-qs-encryption-customer-algorithm | 指定加密算法。目前支持的加密算法是 AES256 |
| x-qs-encryption-customer-key | 用户提供的密钥。密钥必须进行 Base64 编码处理 |
| x-qs-encryption-customer-key-MD5 | 用户提供的密钥的 MD5，用于检查密钥在传输过程中的完整性。密钥 MD5 必须进行 Base64 编码处理 |
| x-qs-copy-source-encryption-customer-algorithm | 源对象的加密算法 |
| x-qs-copy-source-encryption-customer-key | 源对象的密钥。密钥必须进行 Base64 编码处理 |
| x-qs-copy-source-encryption-customer-key-md5 | 源对象的密钥的 MD5。密钥 MD5 必须进行 Base64 编码处理 |

## 响应头字段 (Response Header)

| Header Name | Description |
| --- | --- |
| x-qs-request-id | 服务端会为每个请求生成并返回一个唯一标示，提交工单时如果能附带此 ID 将有助于我们定位问题 |
| x-qs-content-copy-range |  当请求中附带了 `x-qs-copy-range` 头字段时，返回中的 `x-qs-content-copy-range` 头说明了实际返回的数据在文件中的位置。格式为： `bytes start_offset-stop_offset/file_size`。如一个长度为500字节的文件，在请求中有 `x-qs-copy-range: bytes=0-0` 的时候，返回中附带 `x-qs-content-copy-range: bytes 0-0/500` |
| x-qs-encryption-customer-algorithm | 加密时所用的加密算法 |
