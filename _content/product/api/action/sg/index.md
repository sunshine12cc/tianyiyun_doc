---
---

# 防火墙[¶](#api-sg "永久链接至标题")

为了加强位于基础网络 vxnet-0 中的主机或路由器的安全性， 可以在主机或路由器之前放置一个防火墙 (Security Group)。 青云系统为每个用户提供了一个缺省防火墙（ID 之后带有星标）。当然， 您也可以新建更多的防火墙。初始状态下，每个防火墙都不包含任何规则， 即，任何端口都是封闭的，您需要建立规则以打开相应的端口。

注解

如果你的主机使用的是默认防火墙，那么 ping 和 ssh 的端口都是默认打开的，你无需再进行操作。

*   [DescribeSecurityGroups](describe_security_groups.html)
*   [CreateSecurityGroup](create_security_group.html)
*   [DeleteSecurityGroups](delete_security_groups.html)
*   [ApplySecurityGroup](apply_security_group.html)
*   [ModifySecurityGroupAttributes](modify_security_group_attributes.html)
*   [DescribeSecurityGroupRules](describe_security_group_rules.html)
*   [AddSecurityGroupRules](add_security_group_rules.html)
*   [DeleteSecurityGroupRules](delete_security_group_rules.html)
*   [ModifySecurityGroupRuleAttributes](modify_security_group_rule_attributes.html)
*   [CreateSecurityGroupSnapshot](create_security_group_snapshot.html)
*   [DescribeSecurityGroupSnapshots](describe_security_group_snapshots.html)
*   [DeleteSecurityGroupSnapshots](delete_security_group_snapshots.html)
*   [RollbackSecurityGroup](rollback_security_group.html)
*   [DescribeSecurityGroupIPSets](describe_security_group_ipsets.html)
*   [CreateSecurityGroupIPSet](create_security_group_ipset.html)
*   [DeleteSecurityGroupIPSets](delete_security_group_ipsets.html)
*   [ModifySecurityGroupIPSetAttributes](modify_security_group_ipset_attributes.html)
*   [CopySecurityGroupIPSets](copy_security_group_ipsets.html)
