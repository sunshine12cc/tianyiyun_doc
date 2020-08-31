---
---

# SSL传输加密

可选择是否开启 SSL传输加密，默认关闭。更多详细信息参考 [MySQL SSL](https://dev.mysql.com/doc/refman/5.7/en/creating-ssl-rsa-files.html)

![SSL 传输加密](./_images/SSL_cert.png)

**注解**：开启该服务后，需要在同 vxnet 主机获取证书。下载命令如下：
```
wget ftp://master_ip/ca.pem ftp://master_ip/client-cert.pem ftp://master_ip/client-key.pem --ftp-user=ftpuser --ftp-password=ftppassword
```

