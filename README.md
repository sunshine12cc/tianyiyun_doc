# 如何更新 QingCloud 官方文档

本文旨在引导和帮助初次更新 [QingCloud 官方文档](https://docs.qingcloud.com/) 的内部同事。工程师代码写得好，技术文档也非常重要！文档可以帮助用户更好地使用和理解我们的产品，标准化的文档需要做到言简意赅、风格规范。

## 前提条件

- 熟悉 [Markdown](https://www.markdownguide.org/) 语法，可参考 [Markdown 语法说明](https://m.w3cschool.cn/markdownyfsm/markdownyfsm-odm6256r.html)
- 下载安装 Git，参考 [Git 官方文档](https://git-scm.com/downloads)，熟悉 Git 常用命令
- 下载安装 Ruby，参考 [Ruby 官方文档](https://www.ruby-lang.org/zh_cn/downloads/)
- 下载安装 Python (版本不限)，参考 [Python 官网](https://www.python.org/downloads/)

## 文档规范

文档的撰写遵循 Markdown 语法，由于线上文档是多人协同更新，因此在开始更新文档之前，请先熟悉技术文档写作规范。常见的问题如格式问题或标点符号滥用，这类问题都会带给读者极其糟糕的阅读感，所以请保证文档的风格规范和一致。以下仅列出几项最为重要的风格规范，详见 [中文技术文档的写作规范](https://github.com/ruanyf/document-style-guide)。

- 全角中文字符与半角英文字符之间，左右应各有一个空格；如：快速启动 Windows 系统，内存为 8 GB。
- 全角中文字符与半角阿拉伯数字之间，左右应各有一个空格；如：2018 年 1 月 10 日。
- 注解部分需要用大于号 ">"。
- 代码部分用一对连续的三个单引号包起来。
- 示例的 IP 地址需要用两个单引号包起来，且左右应各有一个空格；如：这是 demo 环境 `192.168.0.2`。


## 第一步：申请权限

若需要申请更新文档的权限，请将您的公司邮箱账号发给 `周鹏飞 <pengfeizhou@yunify.com>`，并告知需要更新哪一个模块的文档，目前文档包括以下模块：

- QingCloud 产品文档
- QingStor 对象存储
- QingCloud AppCenter 2.0 开发文档
- QingCloud 映像市场开发文档
- QingCloud 应用中心开发文档

## 第二步：安装 Jekyll

QingCloud 官方文档使用了 Jekyll 来构建网站，Jekyll 是一个静态博客网站生成器，可将 Markdown 格式的文本构建为可发布的静态网站。因此需要在本地安装 Jekyll。

2.1. 安装之前，请先执行以下 5 条命令检查依赖软件的版本，确认已成功安装至本地环境：

```bash

$ ruby -v
ruby 2.3.1p112 (2016-04-26) [x86_64-linux-gnu]

$ git version
git version 2.7.4

$ gem -v
2.5.2.1

$ g++ -v
Using built-in specs.
COLLECT_GCC=g++
COLLECT_LTO_WRAPPER=/usr/lib/gcc/x86_64-linux-gnu/5/lto-wrapper
Target: x86_64-linux-gnu
Configured with: ../src/configure -v --with-pkgversion='Ubuntu 5.4.0-6ubuntu1~16.04.10' --with-bugurl=file:///usr/share/doc/gcc-5/README.Bugs --enable-languages=c,ada,c++,java,go,d,fortran,objc,obj-c++ --prefix=/usr --program-suffix=-5 --enable-shared --enable-linker-build-id --libexecdir=/usr/lib --without-included-gettext --enable-threads=posix --libdir=/usr/lib --enable-nls --with-sysroot=/ --enable-clocale=gnu --enable-libstdcxx-debug --enable-libstdcxx-time=yes --with-default-libstdcxx-abi=new --enable-gnu-unique-object --disable-vtable-verify --enable-libmpx --enable-plugin --with-system-zlib --disable-browser-plugin --enable-java-awt=gtk --enable-gtk-cairo --with-java-home=/usr/lib/jvm/java-1.5.0-gcj-5-amd64/jre --enable-java-home --with-jvm-root-dir=/usr/lib/jvm/java-1.5.0-gcj-5-amd64 --with-jvm-jar-dir=/usr/lib/jvm-exports/java-1.5.0-gcj-5-amd64 --with-arch-directory=amd64 --with-ecj-jar=/usr/share/java/eclipse-ecj.jar --enable-objc-gc --enable-multiarch --disable-werror --with-arch-32=i686 --with-abi=m64 --with-multilib-list=m32,m64,mx32 --enable-multilib --with-tune=generic --enable-checking=release --build=x86_64-linux-gnu --host=x86_64-linux-gnu --target=x86_64-linux-gnu
Thread model: posix
gcc version 5.4.0 20160609 (Ubuntu 5.4.0-6ubuntu1~16.04.10)

$ make -v
GNU Make 4.1
Built for x86_64-pc-linux-gnu
Copyright (C) 1988-2014 Free Software Foundation, Inc.
License GPLv3+: GNU GPL version 3 or later <http://gnu.org/licenses/gpl.html>
This is free software: you are free to change and redistribute it.
There is NO WARRANTY, to the extent permitted by law.

```

2.2. 根据您的系统参考官方文档安装 Jekyll：

- [MacOS](https://jekyllrb.com/docs/installation/macos/)
- [Ubuntu Linux](https://jekyllrb.com/docs/installation/ubuntu/)
- [Windows](https://jekyllrb.com/docs/installation/windows/)
- [Other Linux distros](https://jekyllrb.com/docs/installation/windows/)

> 提示：CentOS 安装可参考 [CentOS 6.x 和 7.x 安装 Jekyll](https://git.internal.yunify.com/qingcloud-product-docs/qingcloud-product-docs/blob/staging/jekyll-centos6.md)。

2.3. 请执行以下命令检查 Jekyll 是否安装成功：

```bash
$ jekyll -v
jekyll 3.8.5
```

## 第三步：克隆远端仓库

3.1. 在克隆之前，需要在本地 hosts 文件添加如下一条 hosts 记录：

```bash
172.16.60.2 git.internal.yunify.com
```

3.2. 在本地通过 git bash 或命令行终端依次执行以下两条命令，克隆远端仓库

```bash
$ git clone git@git.internal.yunify.com:qingcloud-product-docs/qingcloud-product-docs.git
```

3.3. 文档一共包含由于文档是嵌套的结构，执行以下命令初始化各个子仓库：

```bash
$ cd qingcloud-product-docs

$ git submodule init && git submodule update --remote
```

QingCloud 官方文档在 [GitLab](https://git.internal.yunify.com/groups/qingcloud-product-docs) 包含以下 5 个子仓库：

- [QingCloud IaaS Docs](https://git.internal.yunify.com/qingcloud-product-docs/qingcloud-iaas-docs)
- [QingCloud AppCenter2.0 Docs](https://git.internal.yunify.com/qingcloud-product-docs/appcenter-docs)
- [QingStor Docs](https://git.internal.yunify.com/qingcloud-product-docs/qs-docs)
- [QingCloud Appcenter1.0 Docs](https://git.internal.yunify.com/qingcloud-product-docs/appcenter1.0-docs)
- [QingCloud Image App Docs](https://git.internal.yunify.com/qingcloud-product-docs/imageapp)


## 第四步：本地编译预览

4.1. 大概 3 分钟左右，子仓库初始化完毕后，可执行以下命令在本地编译文档网站：

```bash
$ sudo make server
```


4.2. 通过浏览器输入 url:  `http://127.0.0.1:4000/` 预览文档，可以看到与线上文档相同的效果。

![](https://git.internal.yunify.com/qingcloud-product-docs/qingcloud-product-docs/raw/staging/_data/_images/preview-web.png)

## 第五步：编辑文件

5.1. 例如，我们需要更新 QingCloud 云平台产品文档 (IaaS) 下的某篇文档，则在命令行终端进入 `qingcloud-product-docs/_content/product` 目录下：

```bash
$ cd /qingcloud-product-docs/_content/product
```

5.2. 切换到子仓库 product 的 master 分支：

```bash
$ git checkout master
Switched to branch 'master'
Your branch is up to date with 'origin/master'.
```

5.3. 基于 master 分支新建一个分支，例如 docs-test-branch (该分支名可以自定义)，该分支作为您当前的工作分支：

```bash
$ git checkout -b docs-test-branch
Switched to a new branch 'docs-test-branch'
```


5.4. 当前的本地目录就已经在新建的 'docs-test-branch' 分支上，此时可以在本地通过编辑器，如 VSCode (推荐) 或 Subline Text 3 这类编辑器来编辑文档。

> 注意，请确保每一次文档的更新都必须预先 `在本地编译和预览过最终的效果`。

例如，在编辑器中更新了 `qingcloud-product-docs/_content/product` 下的 index.md 文件，保存后可以在命令行终端执行以下命令查看当前分支的文件改动：

```bash
$ git status
On branch docs-test-branch
Changes not staged for commit:
  (use "git add <file>..." to update what will be committed)
  (use "git checkout -- <file>..." to discard changes in working directory)

	modified:   index.md

no changes added to commit (use "git add" and/or "git commit -a")
```

## 第六步：提交更新

完成更新并确认检查无误后，可依次执行以下三条命令添加更新和备注修改，并推送该新分支到远端仓库，即 [qingcloud-product-docs / qingcloud-iaas-docs](https://git.internal.yunify.com/qingcloud-product-docs/qingcloud-iaas-docs) 仓库。

> 注：若需要取消该 index.md 文件的修改，则执行 `git checkout index.md`。

```bash

$ git add .

$ git commit -m "test commit"
[docs-test-branch 6429d63] test commit
 1 file changed, 1 insertion(+), 1 deletion(-)

$ git push origin docs-test-branch
···
```

## 第七步：在 GitLab 提 Merge Request

7.1. 在 [qingcloud-product-docs / qingcloud-iaas-docs](https://git.internal.yunify.com/qingcloud-product-docs/qingcloud-iaas-docs) 页面上方点击 `Merge Requests`，然后点击 `Create Merge Request` 或 `New Merge Request`，都可以创建一个新的合并请求 (MR)。

点击 `Create Merge Request`：

![](https://git.internal.yunify.com/qingcloud-product-docs/qingcloud-product-docs/raw/staging/_data/_images/create-mr.png)

7.2. 这一步需保证 Source branch 为新推送的分支，而 Target branch 则为 master 分支。可点击 `Changes` 的 Tab，检查最近几次提交的修改。

![](https://git.internal.yunify.com/qingcloud-product-docs/qingcloud-product-docs/raw/staging/_data/_images/view-mr.png)

7.3. 检查无误后，即可点击 `Submit merge request`，提交申请将当前分支合并到 master 分支中。

7.4. MR 提交后，待文档负责人或相关的 assinee 审核后，就会将 MR 合并到 master 分支，并同步到线上的官方文档。当文档更新到线上后，请提交者到线上 double check 自己更新的文档是否准确无误、排版样式符合规范。

## 补充

- 若需要新增文档 (即在左侧目录新增条目)，需修改子 repo 中 `index.yml` 文件，修改后执行 `sudo make clean` 然后再执行 `sudo make server` 编译预览。
- 若需要 QingStor 或 AppCenter 部分的文档，需要在 `/qingcloud-product-docs/_content` 目录下，进入 qingstor 或 appcenter 目录，参考上述方式进行修改。

至此，本文档通过 Step By Step 的方式向您演示了如何更新 QingCloud 官方文档。

## FAQ

1、若执行 `sudo make server` 后，遇到如下报错怎么办？

```bash
$ sudo make server
python scripts/generate_index.py
Traceback (most recent call last):
  File "scripts/generate_index.py", line 3, in <module>
    import yaml
ImportError: No module named yaml
make: *** [_data/toc.yml] Error 1
```

答：这是因为缺少编译 yaml 的组件，需依次执行以下命令安装：

**安装 pip 和 pyyaml**

```bash
$ sudo easy_install pip
$ sudo pip install pyyaml
```

2、如何在 Win 10 安装文档编译环境

- win安装依赖管理工具chocolatey  ->  https://chocolatey.org/
- `choco install ruby` （如果有安装其他ruby，最好先卸载，并将新版ruby加入path）
- `Install jekyll` -> https://jekyllrb.com/docs/installation/windows/  
- remove  ./qingcloud-product-docs/makefile 里的 server 里的判断 jekyll 版本的语句
note：if need， please use powershell(root)
