## 简介

Jekyll 是用 Ruby 开发的静态网站框架。本教程适用于 CentOS 6.x 和 CentOS 7 上安装 Jekyll。

## 安装 Ruby

CentOS 6 自带的 Ruby 版本太低，因此需要使用 rvm 安装较新版本的 Ruby。

## 安装 rvm:

```
$ gpg --keyserver hkp://keys.gnupg.net --recv-keys 409B6B1796C275462A1703113804BB82D39DC0E3
$ curl -sSL https://get.rvm.io | bash -s stable
$ source /etc/profile.d/rvm.sh
```

> 提示：如果提示 “gpg: 无法检查签名：没有公钥” 则参考报错提示，依次执行以下命令：

```
$ gpg2 --keyserver hkp://pool.sks-keyservers.net --recv-keys 409B6B1796C275462A1703113804BB82D39DC0E3 7D2BAF1CF37B13E2069D6956105BD0E739499BDB

or if it fails:

$ command curl -sSL https://rvm.io/mpapis.asc | gpg2 --import -
$ command curl -sSL https://rvm.io/pkuczynski.asc | gpg2 --import -
```

## 安装 ruby 2.3.0:

```
$ sudo yum install libyaml
$ rvm install 2.3.0
```

## 设为默认版本:

```
$ rvm use 2.3.0 --default
```

## 安装 Nodejs

Jekyll 依赖 JavaScript 运行时库，需要安装 Nodejs:

```
$ sudo rpm -ivh http://mirrors.zju.edu.cn/epel/6/i386/epel-release-6-8.noarch.rpm
$ sudo yum update
$ sudo yum install nodejs
```

## 安装 Jekyll

首先修改 gem 源，以加快下载速度:

```
$ gem sources --remove https://rubygems.org/
$ gem sources -a http://mirrors.ustc.edu.cn/rubygems/
```

然后执行安装:

```
$ gem install jekyll
```

## 测试

运行下面的命令测试 Jekyll 安装是否成功:

```
$ jekyll --version
jekyll 3.8.5
```


