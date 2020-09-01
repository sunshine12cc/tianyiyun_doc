---
---

# Swift SDK

QingStor Swift SDK 已在 GitHub 开源，下文为简要使用文档。对于 Object-C 开发的应用，我们也在 Swift SDK中做了兼容的工作。
更多详细信息请参见 [https://github.com/yunify/qingstor-sdk-swift](https://github.com/yunify/qingstor-sdk-swift) 。

## 安装

安装 CocoaPod:

```bash
> gem install cocoapods
```

编辑依赖描述文件:

```
source 'https://github.com/CocoaPods/Specs.git'
platform :ios, '10.0'
use_frameworks!

target '' do
  pod 'QingStorSDK'
end
```

安装依赖:

```bash
> pod install
```

## 快速开始

使用 SDK 之前请先在 [青云控制台](https://console.qingcloud.com/access_keys/) 申请 access key 。

### 初始化服务

发起请求前首先建立需要初始化服务:

```swift
Registry.register(accessKeyID: "ACCESS_KEY_ID", secretAccessKey: "SECRET_ACCESS_KEY")
let qsService = QingStor()
```

上面代码初始化了一个 QingStor Service

### 获取账户下的 Bucket 列表

```swift
qsService.listBuckets(input: ListBucketsInput()) { response, error in
    // Print HTTP status code.
    print("\(response?.statusCode)")

    // Print the count of buckets.
    print("\(response?.output.count)")

    // Print the first bucket name.
    print("\(response?.output.buckets?[0].name)")
}
```

### 创建 Bucket

初始化并创建 Bucket, 需要指定 Bucket 名称和所在 Zone:

```swift
let bucket = qsService.bucket(bucketName: "test-bucket")
bucket.put { response, error in
    if let response = response {
        print("StatusCode: \(response.statusCode)")
        if response.output.errMessage == nil {
            print("Bucket \"test-bucket\" created")
        }
    }
}
```

### 获取 Bucket 中存储的 Object 列表

```swift
let input = ListBucketsInput()
qsService.listBuckets(input: input) { response, error in
    if let response = response {
        print("StatusCode: \(response.statusCode)")
        if response.output.errMessage == nil {
            print("Bucket count: \(response.output.count)")
            print("First bucket name: \(response.output.buckets?[0].name)")
        }
    }
}
```

### 创建一个 Object

```swift
let path = Bundle.main.path(forResource: "image", ofType: "jpeg")!
let objectFileURL = URL(fileURLWithPath: path)
let input = PutObjectInput(
    contentLength: objectFileURL.contentLength,
    contentType: objectFileURL.mimeType,
    bodyInputStream: InputStream(url: objectFileURL)
)
bucket.putObject(objectKey:"image.jpeg", input: input) { response, error in
    if let response = response {
        print("StatusCode: \(response.statusCode)")
    }
}
```

### 删除一个 Object


```swift
bucket.deleteObject(objectKey:"image.jpeg") { response, error in
    if let response = response {
        print("StatusCode: \(response.statusCode)")
    }
}
```

### Object-C 兼容

Swift SDK 也支持通过 Object-C 调用的方式, 在 [github项目文档](https://github.com/yunify/qingstor-sdk-swift/blob/master/docs/qingstor_service_usage.md) 能找到更详尽的例子

### 本地时间和网络时间不同步

如果用户本地时间与网络时间不同步会因签名原因造成请求失败。您还需要获取网络时间并将其修改成RFC822格式(在这里我们假设为string格式的gmtTime)。然后将获取到的正确的网络时间在进行获取签名操作之前设置在APISender的headers里。


Swift原生调用

```swift
sender.headers["Date"] = ["\(gmtTime)"]
```

Object-C 兼容模式

```Objective-C
NSMutableDictionary *dict = [NSMutableDictionary dictionaryWithDictionary:requestbuilder.headers];
[dict setValue:gmtTime forKey:@"Date"];
sender.headers = dict;
```
### 使用服务端签名

以创建一个Object为例

Swift原生调用

```swift

//处理文件路径和input
let path = Bundle.main.path(forResource: "image", ofType: "jpeg")!
let objectFileURL = URL(fileURLWithPath: path)
let input = PutObjectInput(
	contentLength: objectFileURL.contentLength,
	contentType: objectFileURL.mimeType,
	bodyInputStream: InputStream(url: objectFileURL)
)

//获取APISender
let sender = bucket.putObjectSender(objectKey:"filename",input: input)

//向服务端请求签名serverAuthorization
let serverAuthorization = "您从服务器获取到的签名字符"

// 因客户端跟服务端通讯可能有时间差，而签名计算结果跟时间密切相关，因此需要将服务端计算签名时所用的时间设置到 request中
sender.headers["Date"] = ["\(gmtTime)"]
sender.headers["Authorization"] = ["\(severAuthorization)"]

//调用sendAPI发送请求
sender.sendAPI(completion:{
	(response:Response<putObjectOut>,error:Error) -> Void in
})

```

Object-C 兼容模式

```Objective-C

//处理文件路径和input
NSString *path = [[NSBundle mainBundle]pathForResource:@"image" ofType:@"jepg"];
NSURL *url = [NSURL URLWithString:path];
NSData *data = [NSData dataWithContentsOfURL:url];

QSPutObjectInput *input = [QSPutObjectInput empty];
input.contentLength = data.length;
input.contentType = @"jepg";
input.bodyInputStream = [NSInputStream alloc]initWithData:data];

//获取QSAPISender
QSAPISender *sender = [bucket putObjectSenderWithObjectKey:"filename" input:input].sender;

//向服务端请求签名后获得serverAuthorization
NSString *serverAuthorization = @"您从服务器获取到的签名字符"

// 因客户端跟服务端通讯可能有时间差，而签名计算结果跟时间密切相关，因此需要将服务端计算签名时所用的时间设置到 request中
NSMutableDictionary *dict = [NSMutableDictionary dictionaryWithDictionary:sender.headers];
[dict setValue:gmtTime forKey:@"Date"];
[dict setValue:serverAuthorization forKey:@"Authorization"];
sender.headers = dict;

//调用sendAPI发送请求
[sender sendPutObjectAPIWithCompletion:
	^(QSPutObjectOutput *output, NSHTTPURLResponse *response, NSError *error) {

}];

```
