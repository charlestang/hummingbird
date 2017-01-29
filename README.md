Hummingbird Report System
============================

Business reports are the key point of the success of product operation in developement.
However, the development of immediate reports is not that easy for programmers.
So that lack of data support is usually situation in start up stage. In order to making
some really important decision, product managers will ask programmers for help.
These repeatedly data requirements of product managers hurt the efficiency of programmmers much.

Actually, most of reports could be implemented by a single SQL statement, but the coresponding
user interface and reports export functionality will cost a lot of time. Which motivated me to
design and implement this report system helping programmer transfer the single SQL statement to
user friendly reports. In this report system, a simple report could be done in less than one minute.


FEATURES
-------------------

- SQL statement editor with syntax highlight
- Database connection management
- SQL execution log and time statistic with error code
- Role based access control system
- Reports can be marked as favorites and showed in sidebar menu
- Subscribe reports through email

REQUIREMENTS
------------
- PHP 5.6.0+
- composer

INSTALLATION
------------
### Clone source code

~~~
clone https://github.com/charlestang/hummingbird.git
~~~

### Download the dependencies through composer

~~~
cd hummingbird
composer install
~~~

### Create the database and set up the configurations

Create a database with the name `hummingbird`, and add the information to config file `config/db.php`.

```php
return [
    'class' => 'yii\db\Connection',
    'dsn' => 'mysql:host=localhost;dbname=hummingbird',
    'username' => 'hummingbird',
    'password' => 'your password',
    'charset' => 'utf8',
];
```

### Database migration

1. Run migration scripts under root directory of the project and import the tables
used by authorization management, `auth_rule`, `auth_item`, `auth_item_child`, and `auth_assignment`

    ~~~
    ./yii migrate --migrationPath=@yii/rbac/migrations
    ~~~

2. Import tables used by user management and menus, `menu` and `user` table

    ~~~
    ./yii migrate --migrationPath=@mdm/admin/migrations
    ~~~

3. run command `./yii migrate/up` to create tables needed by this app

    ~~~
    ./yii migrate/up
    ~~~

### Done!
