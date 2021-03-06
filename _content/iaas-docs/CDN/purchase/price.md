---
---

# 准备工作

## 产品定价

QingCloud CDN 支持按流量的月度消耗累进阶梯价格。每日累计当月流量消耗，每日计算并扣除前一天的费用，月初清零重新开始累计。 具体价格参照下表:

| 流量阶梯   | HTTPS/HTTP 单价 |
| ---------- | --------------- |
| 0-3TB      | 0.23元/GB       |
| 3-10TB     | 0.22元/GB       |
| 10-50TB    | 0.21元/GB       |
| 50-100TB   | 0.19元/GB       |
| 100-1000TB | 0.17元/GB       |
| 1000TB以上 | 0.15元/GB       |

[查看价格计算器](https://www.qingcloud.com/pricing#/CDN)

## 充值与计费

青云账号支持多种充值途径：支付宝、网上银行、微信支付、线下银行转账。 可在 [充值页面](https://console.qingcloud.com/account/wallet/recharge/)选择。微信支付目前只能在 Android 手机的青云 App 中操作。

如果需要发票，请到 [发票管理](https://www.qingcloud.com/account/invoices) 提出申请。

青云执行按用量收费原则，即，您只需要为您使用了的资源付费，并且计费是按秒进行的，并且不设最低消费指标。

您随时可以在 WEB 控制台中查询消费情况 [消费记录](https://console.qingcloud.com/consumptions/query/) 。

## 余额不足提醒

青云系统会定期检查用户余额和当时名下弹性计费资源的消费预估， 如果检查发现余额即将不足，会提前给用户发送通知。

通知策略是：分别在提前 15，7，3，2，1 天时发送提醒。 默认是发送给账号的注册手机号及通知邮箱，如果用户希望自定义接受者列表，可在 [账户信息](https://console.qingcloud.com/account/profile/notify_map/) 中修改“财务通知”对应的通知列表。

## 资源欠费

如果用户余额已不足，资源会被自动暂停，并保留5天时间。 在此期间内用户可随时充值来恢复资源。 如果欠费逾期仍未充值，则资源会被删除，删除的资源会在“回收站”保留2小时， 之后便会被彻底删除，无法再恢复。

所以请您留意系统通知，并及时予以充值，以免造成损失。感谢您的理解和配合。
