

# QingCloud 产品文档规范

本文档旨在让 QingCloud 的文档作者能够对于自己要写的东西有一个清晰的认识，为了实现工作的高效，并对用户负责。有必要在敲键盘之前，对于清晰的约束条件有足够的认识。

## 标点符号和大小写规范

### 标点符号

1. 不重复使用标点符号
2. 全角和半角
3. 使用全形中文标点
4. 数字使用半角字符
5. 遇到完整的英文整句、特殊名词，其内容使用半角标点

### 大小写规范

1. 专有名词使用正确的大小写


默认状态下，技术名称、产品名称的首字母大写，如 Java，Web 等。如该技术术语有自己的默认大小写状态，如 HTML5、.NET、IntelliJ IDEA等，请确保译文中的大小写与其一致。

2.  关于 **QingCloud**，所有出现的地方都必须如此写。

错误的写法：Qingcloud, qingcloud, qingCloud,等。

3. 中文和英文之间要有空格。

## Markdown 语法

### 哲学

Markdown 的目标是实现「易读易写」。

不过最需要强调的便是它的可读性。一份使用 Markdown 格式撰写的文档应该可以直接以纯文本发布，并且看起来不会像是由许多标签或是格式指令所构成。Markdown
语法受到一些既有 text-to-HTML 格式的影响，包括 Setext、atx、Textile、reStructuredText、Grutatext 和 kEtText，然而最大灵感来源其实是纯文本的电子邮件格式。

因此 Markdown 的语法全由标点符号所组成，并经过严谨慎选，是为了让它们看起来就像所要表达的意思。像是在文字两旁加上星号，看起来就像强调。Markdown 的列表看起来，嗯，就是列表。假如你用过电子邮件，区块引言看起来就真的像是引用一段文字。

更多内容请参考[官方网站](https://daringfireball.net/projects/markdown/)。

## 工作流程

如下图所示：

![](https://git.internal.yunify.com/qingcloud-product-docs/qingcloud-product-docs/raw/staging/_data/_images/document_workflow.png)

正式环境访问地址: [https://docs.qingcloud.com](https://docs.qingcloud.com)
预览环境: http://172.16.61.3/ （需连接 Boss VPN 之后才能访问）

关于仓库分支的一些说明：
目前 docs CI 会每分钟 pull 一次最新的 commit，其中：

- master 分支的最新 commit 会部署到正式环境
- staging 分支的最新 commit 会部署到预发布环境
- staging 分支允许自由提交，master 分支必须提交 MR， 通过 @jason review 后才能 merge
- 所有 commit 需要先提交到 staging 分支，否则预发布环境无法查看效果

> 注意： 提交 Merge Request 只能选择提交到 staging 分支，不能直接提交到 master 分支。

### 反馈流程

如上图所示，在预览环境或正式上线之后发现问题（如下所列），及时的到 GitLab 提交 issue，如果能够知道谁是文档作者，直接分配给其即可，如果不能确定，则分配给产品文档负责人，目前是[jsonlee@yunify.com](jsonlee@yunify.com)。
