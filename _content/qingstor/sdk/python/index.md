---
---

# Python SDK

在 QingStor 对象存储于 **2016 年 1 月 6 日** 开始公测时, 我们便在 qingcloud-sdk-python 中以 **面向对象** 形式的接口提供了 QingStor 对象存储的 Python SDK (为行文方便，我们 在下文中将此 SDK 称为 `旧版 Python SDK`)。qingcloud-sdk-python 为 **手动实现** 的 SDK, 旨在提供 **所有青云 QingCloud 服务** 的访问。

为了加快各语言 SDK 的开发效率，及减小各语言 SDK 的运维成本，我们决定将 SDK 的开 发及后期维护自动化。同时，考虑到移动端用户对空间的敏感，我们决定将 QingStor 对象存 储的 SDK 与青云 QingCloud 的其它服务进行分离。

最终，我们于 **2016 年 12 月 5 日** 发布了 SDK 生成工具 [Snips](https://github.com/yunify/snips), 及使用 Snips 生成的六种语言 (Go, Ruby, JAVA, Swift, PHP, JS) 的 SDK。如 [qingstor-sdk-go](https://github.com/yunify/qingstor-sdk-go) 。

为了统一所有语言 SDK 的生成和维护, 我们于 **2017 年 1 月 12 日** 发布了 新版 Python SDK [qingstor-sdk-python](https://github.com/yunify/qingstor-sdk-python), (为行文方便，我们在下文中将此 SDK 称为 `新版 Python SDK`)。

警告

考虑到所有语言 SDK 使用接口的统一，`新版 Python SDK` 的接口实现选择了 **非面向对象** 的形式, 即与 `旧版 Python SDK` 不兼容。`旧版 Python SDK` 除修复 Bug 外，我们将不再维护。

因此，我们推荐新用户使用新版 Python SDK，同时建议使用 `旧版 Python SDK` 的用户切换 到 `新版 Python SDK` 。

- [新版 Python SDK](qingstor_sdk.html)
- [旧版 Python SDK](qingcloud_sdk.html)
