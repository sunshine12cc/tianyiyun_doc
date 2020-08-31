---
---

# qsctl v2.0 变更日志

### 2.2.0 - 2020-07-30

新增

- cmd/shell: 新增了交互式命令行 shell 界面。(#310)

修复

-  cmd/rb: 修复了 rb 命令中 zone 标志未正常生效的问题。(#314)

移除

- 移除所有非 shell 中命令的交互操作。

### 2.1.2 - 2020-06-30

变更

- mod: 升级 storage 组件以适配不同操作系统路径分隔符。(#302)

修复

- cmd/progress: 修复了进度条计数器负数导致的异常。(#296)

### 2.1.1 - 2020-06-03

变更

- i18n: 如果检查语言环境变量失败，将语言设置为 en-US 而不是退出。(#291)

修复

- cmd/utils: 修复了 qsctl 在非交互环境下不可用的问题。(#292)
- 修复了在任务执行期间错误信息未能正确返回的问题。

### 2.1.0 - 2020-05-28

新增

- cmd/stat: 新增 stat 命令查看 bucket 详细信息。(#279)
- cmd: 新增全局 zone 标志以手动设置在哪个 zone 执行命令。(#282)
- cmd/ls: 新增对 ls -l 查看 bucket 列表详细信息的支持。(#280)

修复

- cmd/progress-bar: 修复进度条组件报错 data race 的问题。(#284)

### 2.0.1 - 2020-05-21

变更

- misc: 修改 rpm/deb 文件中的安装路径为 /usr/bin. (#275)

修复

- mod: 升级 Noah 组件以修复从 QingStor 复制大文件到本地出错的问题。(#276)

### 2.0.0 - 2020-05-12

新增

- cmd: 新增对 --no-progress 标志的支持。(#262)
- 新增对 Linux 打包发布的支持。(#263)

### 2.0.0-rc.2 - 2020-05-08

[详情](https://github.com/qingstor/qsctl/compare/v2.0.0-rc.1...v2.0.0-rc.2)

新增

- cmd: 执行 rb -f 和 rm 操作时，新增二次确认操作。(#253)
- cmd: 提升进度条性能。(#256)

### 2.0.0-rc.1 - 2020-04-08

[详情](https://github.com/qingstor/qsctl/compare/v2.0.0-beta.2...v2.0.0-rc.1)

新增

- cmd/sync: 新增更多 sync 命令的选项支持。(#221)

变更

- \*: 将 task 相关组件单独拆分到 qingstor/noah 项目中。(#195)
- cmd: 对于已知错误返回时，不显示命令帮助信息。(#206)
- cmd/stat: 修改 stat 命令显示的文件名为对象全名。(#209)
- cmd/ls: 当添加 -h (--human-readable) 选项时，对输出做对齐处理。(#248)

修复

- utils: 修复了对于 QingStor 对象存储，在 Windows 系统中不能正确处理工作路径的问题。(#212)
- cmd/stat: 修复了 md5 值在 stat 命令中没有返回的问题。(#216)
- cmd/ls: 修复了 ls 命令在是否添加递归选项时行为不一致的问题。(#219)

### 2.0.0-beta.2 - 2019-12-10

[详情](https://github.com/qingstor/qsctl/compare/v2.0.0-beta.1...v2.0.0-beta.2)

新增

- cmd/mv: 实现 mv 命令逻辑。(#171)
- cmd/sync: 实现 sync 命令的 --ignore-existing 选项逻辑。(#172)
- i18n: 添加 i18n 支持。(#184)

变更

- \*: 只在用户添加 --debug 选项时打印 debug 日志信息。(#180)
- \*: 将项目从 yunify 移动到 qingstor 下。
- cmd: 提升 qsctl 的交互体验。(#191)

修复

- cmd: 修复了对象的大小未能被正确使用的问题。(#189)

### 2.0.0-beta.1 - 2019-11-07

[详情](https://github.com/qingstor/qsctl/compare/v2.0.0-alpha.8...v2.0.0-beta.1)

新增

- 优化递归地删除对象操作，现在使用异步 list. (#132)
- 实现强制删除 bucket 的功能。(#134)
- makefile: 使得 go build 选项可复用。(#148)
- cmd: 添加初始化向导，用于初始化配置项。(#152)
- task: 添加基于 workload 的调度器。(#159)
- cmd/cp: 实现递归复制的功能。(#155)
- cmd/sync: 实现 sync 同步命令的功能。(#162)
- cmd/cp: 添加从根目录进行复制的支持。(#164)

变更

- 将对于本地文件系统的操作抽象为 posixfs storager. (#130)
- \*: 重构任务调度系统。(#146)
- pkg/schedule: 直接进行任务提交操作。(#147)
- \*: 重构任务类型系统。(#151)

修复

- cmd/ls: 修复 ls 命令在输出未完成时就退出的问题。(#128)
- task: 修复了分段未能正确上传的问题。(#154)
- cmd/utils/setup: 修复了无法在不存在的目录创建配置文件的问题。(#165)

### 2.0.0-alpha.8 - 2019-10-17

[详情](https://github.com/qingstor/qsctl/compare/v2.0.0-alpha.7...v2.0.0-alpha.8)

新增

- cmd/stat: 添加 stat 命令显示更新时间的支持。(#123)
- cmd/ls: 添加 ls 命令，在列取对象时利用流式异步输出。(#122, #121, #120)
- 添加对任务中的错误处理。(#113)
- utils: 添加 bucket 名称的验证方法。(#109)
- misc: 添加项目对应 codecov 的支持。(#108)

变更

- 使用新的抽象存储层替换存储相关的逻辑。(#118)
- cmd: 利用 TriggerFault 方法统一错误处理。(#116)
- pkg: 将类型相关文件移至 pkg 包中，并合并 utils，这样更有利于第三方进行引入。(#111)
- 使用新的任务执行框架。(#107)
- 修改以下命令以适用新的任务框架: cp(#107), mb(#110), presign(#114), rb(#115), rm(#119), stat(#112)

### 2.0.0-alpha.7 - 2019-07-15

[详情](https://github.com/qingstor/qsctl/compare/v2.0.0-alpha.6...v2.0.0-alpha.7)

新增

- action/stat: 添加 stat 命令对格式化字符串的支持。(#95)

修复

- cmd/stat: 修复了 stat 命令无法正常输出到标准输出的问题。(#94)

### 2.0.0-alpha.6 - 2019-07-14

[详情](https://github.com/qingstor/qsctl/compare/v2.0.0-alpha.5...v2.0.0-alpha.6)

新增

- cmd: 添加 rb 命令用于删除一个空的 bucket。(#91)

变更

- main: 重构了配置文件加载的逻辑。(#92)

### 2.0.0-alpha.5 - 2019-07-11

[详情](https://github.com/qingstor/qsctl/compare/v2.0.0-alpha.4...v2.0.0-alpha.5)

新增

- action: 对 copy 操作添加单元测试。(#88)

修复

- action/copy: 修复了从远端复制时对象路径解析错误的问题。(#87)

### 2.0.0-alpha.4 - 2019-07-11

[详情](https://github.com/qingstor/qsctl/compare/v2.0.0-alpha.3...v2.0.0-alpha.4)

变更

-  misc: 升级 qingstor-go-sdk 到 3.0.1 版本。

修复

- action/copy: 修复了 md5 计算不正确的问题。(#85)

### 2.0.0-alpha.3 - 2019-07-10

[详情](https://github.com/qingstor/qsctl/compare/2.0.0-alpha.2...2.0.0-alpha.3)

新增

- action: 对 utils 组件添加单元测试。
- 添加 mb 命令，用于创建新的 bucket。
- storage/mock: 利用 Mock 方法模拟 MockObjectStorage. (#82)

变更

- action/utils: 重构解析 QingStor 对象路径的 ParseQsPath 方法。
- 重构初始化命令选项的方式。
- action/bucket: 统一记录日志的操作，修改创建 bucket 的返回。
- action/bucket: 将创建 bucket 的逻辑移动到帮助方法中。
- cmd/mb: 修改检查必须选项的方法。(#78)
- storage: 将帮助方法转换至统一的存储接口，以便于测试。(#79)


修复

- cmd: 修复了子命令的选项被错误的设置的问题。
- action/utils: 修复了对象的键值没有被正确解析的问题。
- action/utils: 修复了 bucket 名称检查失效的问题。
- action/copy: 修复了 wg.Add(1) 操作未在任务提交后正确执行的问题。
- cmd/rm: 实现了 rm 命令，用于删除单个对象。(#81)

### 2.0.0-alpha.2 - 2019-07-08

[详情](https://github.com/qingstor/qsctl/compare/2.0.0-alpha.1...2.0.0-alpha.2)

修复

- action/copy: 修复了写缓冲区未能正常写入的问题。
- action/utils: 修复了 "-" 在合法 bucket 名称中被验证失败的问题。
