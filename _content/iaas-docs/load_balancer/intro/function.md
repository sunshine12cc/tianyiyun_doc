---
---

# 负载均衡产品功能

**支持 rsyslog 远端主机日志**

可以输出负载均衡器的日志流到指定的主机。

**支持透明代理**

后端主机不做任何修改，直接获取客户端真实 IP。

**支持服务器证书**

在 HTTPS 监听模式下，负载均衡器支持上传 SSL 服务器证书。

**支持安全防护**

自带 Web 应用防火墙能力，用于保护您的 Web 应用程序免受 SQL 注入，XSS 等攻击的损害，可降低 CC 攻击对系统的影响，为您的业务保驾护航。

**支持健康检查，保障服务高可用**

* 定期检查后端服务器运行状态， 出现异常后自动隔离该后端服务，并将请求转发给其他健康的后端服务，实现高可用性。
* 可配置多种检查选项：检查间隔、超时时间、不健康阈值、健康阈值。

**多种均衡方式**

* 轮询： 用户可自定义后端服务器的权重，流量经负载均衡器后按权重比例，将请求轮流发送给后端服务器，常用于短连接服务，例如 HTTP 等服务。
* 最少连接： 优先将请求发给拥有最少连接数的后端服务器，常用于长连接服务，例如数据库连接等服务。
* 源地址： 将请求的源地址进行 hash 运算，并结合后端服务器的权重派发请求至某匹配的服务器，使同一个客户端IP的请求始终被派发至某特定的服务器，实现会话保持。该方式适合负载均衡无 cookie 功能的 TCP 协议。

**支持跨可用区均衡**

在区域（Region）中创建负载均衡器（LB），不同可用区的节点均能通过轮询、最少连接和源地址的均衡方式将来自公网的访问分发到不同可用区节点。