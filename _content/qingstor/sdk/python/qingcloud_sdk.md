---
---
# 旧版 Python SDK

> **该版本已不再维护，不会再增加新的功能, 只会进行 BUG 修复。**

QingStor 对象存储的旧版 Python SDK 包含在 QingCloud SDK Python 之中，安装方法 [参见 QingCloud SDK Python](https://docs.qingcloud.com/qingstor/sdk/python/index) 。

使用 qingcloud-sdk 前请先在 [青云控制台](https://console.qingcloud.com/access_keys/) 申请 access key 。

## 建立连接

发起请求前首先建立连接:

```python
>>> import qingcloud.qingstor
>>> conn = qingcloud.qingstor.connect(
 'pek3a.qingstor.com',
 'access key id',
 'secret access key'
 )
```

上面代码中得到的 `conn` 是 QSConnection 的实例，在接下来的教程中会继续用它创建 bucket 对象和初始化 multipart 上传

## 创建存储空间

创建存储空间, 需要指定空间名称:

```python
>>> mybucket = conn.create_bucket('mybucket')
```

## 设置存储空间权限

将存储空间 mybucket 的权限设置为公开可读:

```python
>>> from qingcloud.qingstor.acl import ACL, Grant
>>> grant = Grant(
...     permission='READ',
...     type='group',
...     name='QS_ALL_USERS'
... )
>>> acl = ACL()
>>> acl.add_grant(grant)
>>> mybucket.set_acl(acl)
True
```

## 创建对象

使用 mybucket 创建一个 object 对象:

```python
>>> key = mybucket.new_key('mydir/myfile')
```

此时得到的 `key` 实例代表一个 object，我们使用它上传本地文件到存储空间

```python
>>> with open('/tmp/myfile') as f:
>>>     key.send_file(f)
```

## 获取对象列表

获取存储空间 mybucket 中 mydir 目录下的对象:

```python
>>> for key in mybucket.list(prefix='mydir/'):
>>>     print key.name
mydir/myfile
```

## 删除对象

删除存储空间中的对象:

```python
>>> mybucket.delete_key('myobject')
```
