Hummingbird Report System
============================

在业务开发的过程中，及时跟进的业务数据报表，是产品运营赖以成功的关键。但是，报表的开发是极其耗时
的一件事情，所以，现实中的业务开发，往往面临着数据匮乏，产品盲目运营的困境。但是很多关键的决策，
还是必须依赖数据决策，这时候，产品经理就会要求程序员临时拉一下数据，这种看似很小的要求，
而且因为缺乏报表，也显得很合理，但是确实对程序员的效率是一种伤害，而且因为对数据的认识不足，
往往提出的数据需求并不是很准确，免不了一而再，再而三地要求程序员拉取数据。这就造成了浪费。

实际经验表明，绝大多数报表就是单条 SQL 语句就可以解决的问题。但是还要配套开发一整套的显示界面，
还要配合导出，就显得十分麻烦，于是我们想到了这么一个系统，可以把单条的 SQL 语句变成一个报表，
配备有比较完善的展示，导出功能，于是做到了可以一分钟开发一个简易报表，能快速满足运营人员的数据需求。

有些团队也会配备一些数据分析人员，这些人一般都达不到程序员的水平，只能写一些简单的 SQL，
能比较熟练的运用 Excel，这时候，这个系统可以很好的服务这个角色的工作，让程序员的工作得到很大的解放。
提高了整个研发团队生产效率。

特性 FEATURES
-------------------

- SQL 语句编辑器，语法高亮显示
- 数据库连接界面化管理
- SQL 语句执行的日志，时间统计，错误码记录
- 权限角色系统，支持标准的 RBAC
- 报表收藏，添加到侧边栏菜单
- 邮件订阅报表

系统要求 REQUIREMENTS
------------
- PHP 5.6.0+
- composer

安装办法 INSTALLATION
------------
### clone 代码

暂时还不提供 Release 包，所以，只有源代码的安装方式。

~~~
clone https://github.com/charlestang/hummingbird.git
~~~

### 下载代码的依赖

clone 代码后，首先在目录下执行 composer install

~~~
cd hummingbird
composer install
~~~

### 创建数据库、配置数据库

创建名为 hummingbird 的数据库，将数据库的用户名密码加入到配置文件里面，`config/db.php`

```php
return [
    'class' => 'yii\db\Connection',
    'dsn' => 'mysql:host=localhost;dbname=hummingbird',
    'username' => 'hummingbird',
    'password' => 'your password',
    'charset' => 'utf8',
];
```

### 数据库迁移 Migration

1. 在根目录下执行 Migration 脚本设置权限管理的相关数据表, 注入 `auth_rule`， `auth_item`，
`auth_item_child`，`auth_assignment` 四个表

    ~~~
    ./yii migrate --migrationPath=@yii/rbac/migrations
    ~~~

2. 然后执行第二个脚本设置用户管理和菜单管理的相关表, 注入 `menu` 表, 和 `user` 表

    ~~~
    ./yii migrate --migrationPath=@mdm/admin/migrations
    ~~~

3. 执行 ./yii migrate/up 创建本App需要使用的数据库表

    ~~~
    ./yii migrate/up
    ~~~

### Done!
