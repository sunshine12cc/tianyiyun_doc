---
---

# Scala SDK

QingStor Scala SDK 已在 GitHub 开源，下文为简要使用文档。更多详细信息请参见 [https://github.com/yunify/qingstor-sdk-scala](https://github.com/yunify/qingstor-sdk-scala) 。

## 安装

点击 [此处](https://pek3a.qingstor.com/releases-qs/qingstor-sdk-scala/qingstor-sdk-scala-latest.tar.gz) 下载最新版的 Jar 包，也可访问 GitHub 项目的 [Releases](https://github.com/yunify/qingstor-sdk-scala/releases) 页面查看和下载历史版本。

> 文件名中包含 fat 后缀的 Release 中包含了 SDK 所需的依赖，使用时无需手动加载其依赖包，如 qingstor-sdk-scala-v2.0.0_2.11_fat.jar。而文件名中不包含 fat 的 Release 中没有包含相关依赖，需要手动指定。

描述 SDK 所需依赖关系的 SBT 文件片段样例如下:

```scala
libraryDependencies ++= {
  val akkaHttpVersion = "10.0.5"
  val circeVersion = "0.7.1"
  Seq(
    "com.typesafe.akka" %% "akka-http-core" % akkaHttpVersion,
    "com.typesafe.akka" %% "akka-http" % akkaHttpVersion,
    "io.circe" %% "circe-generic" % circeVersion,
    "io.circe" %% "circe-parser" % circeVersion,
    "org.yaml" % "snakeyaml" % "1.17",
    "de.heikoseeberger" %% "akka-http-circe" % "1.15.0"
  )
}
```

## 快速开始

使用 SDK 之前请先在 [青云控制台](https://console.qingcloud.com/access_keys/) 申请 Access Key。

### 初始化服务

发起请求前首先建立需要初始化服务:

```scala
import com.qingstor.sdk.config.QSConfig
import com.qingstor.sdk.service.QingStor

val config = QSConfig("ACCESS_KEY_ID", "SECRET_ACCESS_KEY")
val qsService = QingStor(config)
```

上面代码初始化了一个 QingStor Service

### 获取账户下的 Bucket 列表

```scala
import scala.concurrent.Await

val outputFuture = qsService.listBuckets(QingStor.ListBucketsInput())
val listBucketsOutput = Await.result(outputFuture, Duration.Inf)

// Print HTTP status code.
// Example: 200
println(listBucketsOutput.statusCode.getOrElse(-1))

// Print the count of buckets.
// Example: 5
println(listBucketsOutput.count.getOrElse(-1))

// Print the first bucket name.
// Example: "test-bucket"
println(listBucketsOutput.buckets.flatMap(_.head.name).getOrElse("No buckets"))
```

### 创建 Bucket

初始化并创建 Bucket, 需要指定 Bucket 名称和所在 Zone:

```scala
import com.qingstor.sdk.service.Bucket

val bucket = Bucket(config, "test-bucket", "pek3a")
val outputFuture = bucket.put(Bucket.PutBucketInput())
```

### 获取 Bucket 中存储的 Object 列表

```scala
val outputFuture = bucket.listObjects(Bucket.ListObjectsInput())
val listObjectsOutput = Await.result(outputFuture, Duration.Inf)

// Print the HTTP status code.
// Example: 200
println(listObjectsOutput.statusCode.getOrElse(-1))

// Print the key count.
// Example: 7
println(listObjectsOutput.keys.map(_.length).getOrElse(-1))
```

### 创建一个 Object

例如一张图片:

```scala
// Open file
val file = new File("/tmp/test.jpg")
val input = PutObjectInput(
  // Because this SDK used akka-http as http library, it's useless to set Content-Length here
  contentLength = file.length().toInt,
  body = file
)
val outputFuture = bucket.putObject("test.jpg", input)
val putObjectOutput = Await.result(outputFuture, Duration.Inf)
file.close()

// Print the HTTP status code.
// Example: 201
println(putObjectOutput.statusCode.getOrElse(-1))
```

### 删除一个 Object

```scala
val outputFuture = bucket.deleteObject(arg, Bucket.DeleteObjectInput())

// Print the HTTP status code.
// Example: 204
println(outputFuture.statusCode.getOrElse(-1))
```

### 设置 Bucket ACL**

```scala
val input = PutBucketACLInput(
  aCL = List(ACLModel(
    grantee = GranteeModel(
      typ = "user",
      id = Some("usr-xxxxxxxx")
    ),
    permission = "FULL_CONTROL"
  ))
)
val outputFuture = bucket.putACL(input)
val putBucketACLOutput = Await.result(outputFuture, Duration.Inf)

// Print the HTTP status code.
// Example: 200
println(putBucketACLOutput.statusCode.getOrElse(-1))
```
