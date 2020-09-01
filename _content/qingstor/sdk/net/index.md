---
---
# .NET SDK

QingStor SDK for .NET 已在 GitHub 开源，下文为简要使用文档。更多详细信息请参见 [https://github.com/yunify/qingstor-sdk-net](https://github.com/yunify/qingstor-sdk-net) 。

## 安装

可通过以下三种安装方式任一种安装。

1. 直接下载源码并将其添加至项目:

   ```bash
   > git clone https://github.com/yunify/qingstor-sdk-net.git
   ```

1. 直接添加 DLL 引用

   在 GitHub 的 [release 页面](https://github.com/yunify/qingstor-sdk-net/releases) 下载相应版本的 DLL，然后将其添加至项目引用。由于此 SDK 依赖于 Json.NET，可以添加该 SDK 对应版本的 Newtonsoft.Json.dll 引用或者使用 NuGet 来安装它:

   ```cmd
   > Install-Package Newtonsoft.Json
   ```

1. 通过包管理器(NuGet)安装

   例如在 Visual Studio 2013 中，打开 NuGet 程序包管理器搜索 QingStor_SDK_NET 或者在控制台中键入以下命令(其中，QingStor_SDK_NET45 表示 .NET Framework 4.5 平台下的 SDK):
   ```cmd
   > Install-Package QingStor_SDK_NET45
   ```

## 快速开始

使用 SDK 之前请先在 [青云控制台](https://console.qingcloud.com/access_keys/) 申请 access key 。

### 初始化服务

发起请求前首先建立需要初始化服务:

```c#
using QingStor_SDK_NET.Common;
using QingStor_SDK_NET.Service;

CConfig Config = new CConfig("Config.yaml");
CQingStor Service = new CQingStor(Config);
```

上面代码初始化了一个 QingStor Service

### 获取账户下的 Bucket 列表

```c#
CListBucketsOutput ListBuckets = Service.ListBuckets(null);

// Print the HTTP status code.
// Example: 200
Console.Write(ListBuckets.StatusCode);

// Print the bucket count.
// Example: 5
Console.Write(ListBuckets.count);
```

### 创建 Bucket

初始化并创建 Bucket, 需要指定 Bucket 名称和所在 Zone:

```c#
CBucket Bucket = Service.Bucket("bucket-name", "pek3a");
CPutBucketOutput PutBucketOutput = Bucket.Put();
```

### 获取 Bucket 中存储的 Object 列表

```c#
CListObjectsOutput ListObjectsOutput = Bucket.ListObjects(null);

// Print the HTTP status code.
// Example: 200
Console.Write(ListObjectsOutput.StatusCode);

// Print the key count.
// Example: 0
Console.Write(ListObjectsOutput.keys.Length);
```

### 创建一个 Object

例如上传一张屏幕截图:

```c#
CPutObjectInput PutObjectInput = new CPutObjectInput();
PutObjectInput.Body = new FileStream("/tmp/Screenshot.jpg", FileMode.Open);
CPutObjectOutput PutObjectOutput = Bucket.PutObject("Screenshot.jpg", PutObjectInput);

// Print the HTTP status code.
// Example: 201
Console.Write(PutObjectOutput.StatusCode);
```

### 删除一个 Object

```c#
CDeleteObjectOutput DeleteObjectOutput = BucketObj.DeleteObject("Screenshot.jpg");

// Print the HTTP status code.
// Example: 204
Console.Write(DeleteObjectOutput.StatusCode);
```

### 设置 Bucket ACL

```c#
CGranteeType Grantee = new CGranteeType() { id = "usr-id", type = "user" };
CACLType ACL = new CACLType() { grantee = Grantee, permission = "FULL_CONTROL" };
CPutBucketACLInput PutBucketACLInput = new CPutBucketACLInput();
PutBucketACLInput.acl = new CACLType[] { ACL };
CPutBucketACLOutput PutBucketACLOutput = Bucket.PutACL(PutBucketACLInput);

// Print the HTTP status code.
// Example: 200
Console.Write(PutBucketACLOutput.StatusCode);
```
