---
---

# 备份[¶](#api-snapshot "永久链接至标题")

备份(Snapshot)用于在块设备级别(block device level)上进行硬盘的备份与恢复， 可以同时对多张硬盘做备份（包括系统盘和数据盘），也可以对正在运行的主机做在线备份。 一张硬盘可以有多个备份链，每条备份链包括一个全量备份点以及多个增量备份点， 您可以随时从任意一个备份点恢复数据。

*   [DescribeSnapshots](describe_snapshots.html)
*   [CreateSnapshots](create_snapshots.html)
*   [DeleteSnapshots](delete_snapshots.html)
*   [ApplySnapshots](apply_snapshots.html)
*   [ModifySnapshotAttributes](modify_snapshot_attributes.html)
*   [CaptureInstanceFromSnapshot](capture_instance_from_snapshot.html)
*   [CreateVolumeFromSnapshot](create_volume_from_snapshot.html)
