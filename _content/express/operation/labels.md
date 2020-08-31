---
---

# 标签

在 Express 中，标签 (Tag) 用于对您的云平台资源进行分类分组，更方便日常的资源分类管理。

随着您的业务的增长，资源的使用也必将日益增多，日积月累，资源检索会成为日常的需求，那么贴标签这样一个功能，可以让您随时随地的根据实际情形来过滤自己的各种基础设施资源。下面我们就以一个为一组虚拟机贴标签为例，演示标签的使用方式。

## 创建标签

1、点击 「运维工具」，选择 「标签」，点击 「+ 创建标签」。

![](https://pek3b.qingstor.com/kubesphere-docs/png/20190415174854.png)

2、在弹窗中，选择红色图标，标签名可自定义，例如输入 `开发环境`，点击 「创建」 即可完成标签的创建。

![](https://pek3b.qingstor.com/kubesphere-docs/png/20190415175030.png)

## 给资源打标签

1、我们以给虚拟机打标签为例，回到虚拟机页面，选中要打标签的虚拟机，然后点击 「绑定标签」：

![](https://pek3b.qingstor.com/kubesphere-docs/png/20190415175519.png)

2、在弹窗中选择标签 `开发环境`，点击 「绑定」。

![](https://pek3b.qingstor.com/kubesphere-docs/png/20190415175708.png)

3、在虚拟机列表页，在搜索框选择标签：`开发环境`，确认该标签已绑定至当前虚拟机。

![](https://pek3b.qingstor.com/kubesphere-docs/png/20190525192008.png)

## 删除或解绑标签

在标签详情页，用户可以删除或解绑标签。

![](https://pek3b.qingstor.com/kubesphere-docs/png/20190525194930.png)


