# QingCloud Product Docs

## Clone

You should init all submodules before build.

```bash
git clone git@git.internal.yunify.com:qingcloud-product-docs/qingcloud-product-docs.git
git submodule init && git submodule update --remote
```

## Install

Before build docs, you should have ruby installed and run following commands:

```bash
gem install jekyll bundler
bundle install
```

## Write

[QingCloud Product Docs](https://git.internal.yunify.com/groups/qingcloud-product-docs) includes following submodule:

- [QingCloud AppCenter2.0 Docs](https://git.internal.yunify.com/qingcloud-product-docs/appcenter-docs)
- [QingCloud Appcenter1.0 Docs](https://git.internal.yunify.com/qingcloud-product-docs/appcenter1.0-docs)
- [QingCloud IaaS Docs](https://git.internal.yunify.com/qingcloud-product-docs/qingcloud-iaas-docs)
- [QingCloud Image App Docs](https://git.internal.yunify.com/qingcloud-product-docs/imageapp)
- [QingStor Docs](https://git.internal.yunify.com/qingcloud-product-docs/qs-docs)

### Add new project

If you need to add a new project, you should:

1. Add a new project into group [qingcloud-product-docs](https://git.internal.yunify.com/groups/qingcloud-product-docs)
1. Add submodule into this project, for example: `git submodule add git@git.internal.yunify.com:qingcloud-product-docs/qs-docs.git _content/qingstor`
1. Update [index.yml](https://git.internal.yunify.com/qingcloud-product-docs/qingcloud-product-docs/blob/master/index.yml) to add it into index.
1. Commit you changes and ask someone to review your changes.

### Add new content

If you want to add new content, **don't update submodule directly**, you should add docs in your project.

## Usage

### Preview

You can use following commands for previewing:

```bash
make server
```

All pages will be generated to `_site`.

### Update submodule

You can use following commands to update all submodule:

```bash
make update
```

### Generate to pdf

Firstly, you should start server with

```bash
make pdf-server
```

Then, you can generate pdf with

```bash
make build-pdf
```

> Please visit [QingStor TOC](https://git.internal.yunify.com/qingcloud-product-docs/qs-docs/blob/master/pdf_toc.md) and [QingStor Index](https://git.internal.yunify.com/qingcloud-product-docs/qs-docs/blob/master/pdf_index.md) for more info about PDF TOC and Index control.

## Structure

All submodule should follow these structure:

```bash
.
├── index.yml
├── index.md
├── solutions
│   ├── _images
│   │   ├── bucket_external_mirror_diagram.png
│   │   └── object_list.png
│   ├── index.md
│   └── web_hosting.md
└── third_party_integration/
```

We will use the `index.yml` to build toc for whole site, you can visit <https://git.internal.yunify.com/qingcloud-product-docs/qs-docs/blob/master/index.yml> for more infomation.

For example:

- `index.md` will be generated into `index.html` which can be accessed by `/` or `/index.html`
- `solutions/index.md` will be generated into `solutions/index.html` which can be accessed by `/solutions` or `/solutions/index.html`
- `solutions/app_integration.md` will be generated into `solutions/app_integration.html`
- `solutions/_images/object_list.png` will be generated into `solutions/_images/object_list.png`, docs under `solutions` can use `![](_images/object_list.png)` to insert this image.

## Tips

### Nginx

Should add `$uri.html` into try_file statement.

```nginx
location / {
    # First attempt to serve request as file, then
    # then as html file, then as directory, then
    # fall back to displaying a 404.
    try_files $uri $uri.html $uri/ =404;
}
```

## Issue

Please submit [Issue](https://git.internal.yunify.com/qingcloud-product-docs/qingcloud-product-docs/issues) if you have any trouble, or visit your PM for help.
