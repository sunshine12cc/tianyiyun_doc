---
---

# 应用版本管理

## 基本介绍

“应用版本”对于一款应用来说是非常重要和关键的概念。一款应用从创建、发布到更新，整个过程中很可能需要提交多个应用版本，每个版本中都包括完整的应用服务功能，其主要属性如下:

- **版本名称**: 用数字或者字符表示应用的版本号，例如 1.0、2.1.20。若没有提供版本名称，系统将自动指定一个；
- **版本状态**: 包括准备提交、审核中、被拒绝、已通过、已上架、已下架和已删除几种状态，不同的状态对应不同的操作；
- **配置文件**: 用于描述应用具体服务的各类文件，文件格式支持 TAR，TAR.GZ，ZIP 和 TAR.BZ，后面将详细介绍配置文件及其制作方法和步骤；
- **版本描述**: 此描述内容主要用来记录此版本的具体更新，便于用户在升级应用时做详细了解。