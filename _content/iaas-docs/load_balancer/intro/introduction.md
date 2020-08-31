---
---

# 负载均衡简介

负载均衡器可以将来自多个公网地址的访问流量分发到多台主机上， 并支持自动检测并隔离不可用的主机，从而提高业务的服务能力和可用性。 同时，你还可以随时通过添加或删减主机来调整你的服务能力，而且这些操作不会影响业务的正常访问。
负载均衡器支持包括 TCP/UDP 协议的四层代理和 HTTP/HTTPS/SSL 协议的七层代理。
并且四层、七层都支持透明代理，可以让后端主机不做任何更改，直接获取客户端真实IP。
另外，负载均衡器还支持灵活配置多种转发策略，实现高级的自定义转发控制功能。

## 产品优势

**超高性能**

支持负载均衡器集群 (LB Cluster) ，可将来自一个公网IP的流量分散至多个负载均衡器节点做并发处理，突破单个负载均衡器节点的能力瓶颈，可承载峰值流量达1Gbps，支撑千万级别并发访问请求。

**多种协议支持**

支持包括 HTTP/HTTPs/TCP/UDP 在内的多种协议，同时提供灵活多样的配置选项：负载均衡器可选配连接公网或放置于私有网络中；可连接基础网络或私有网络中的主机作为后端服务器。

**灵活的转发策略**

负载均衡的后端服务器可根据业务需求设置为对等或不对等两种模式。如果后端不对等，可以通过自定义转发策略来进行更高级转发控制。目前，可支持“按域名转发”和“按 URL 转发”两种规则，每条转发策略可配置多条规则，并可以自定义规则之间的匹配方式。

**WAF 安全防护**

负载均衡器自带Web 应用防火墙能力，通过检查 HTTP/HTTPS 流量来实现内容过滤，可用来保护您的 Web 应用程序免受 SQL 注入，XSS等攻击的损害，可降低 CC 攻击对系统的影响。您还可以通过自定义规则灵活有效的阻止非法流量，保证应用的稳定运行。

**多活负载均衡**

由多个可用区（Availability Zone）组成的区域（Region）中创建的负载均衡集群（LB Cluster），默认支持多可用区部署（ Multi-AZ deployment，简称 MZ ），可实现将来自公网的访问以灵活的策略分发到不同可用区节点，从而快速隔离位于故障区域的后端资源。