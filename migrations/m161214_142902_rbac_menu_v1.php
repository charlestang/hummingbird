<?php

use yii\db\Migration;

class m161214_142902_rbac_menu_v1 extends Migration
{

    public function up()
    {
        $this->batchInsert(
            '{{%auth_item}}',
            ['name', 'type', 'description', 'rule_name', 'data', 'created_at', 'updated_at'],
            [
            ['/database/*', 2, NULL, NULL, NULL, 1481464892, 1481464892],
            ['/report/create', 2, NULL, NULL, NULL, 1481465517, 1481465517],
            ['/report/export-by-id', 2, NULL, NULL, NULL, 1483001009, 1483001009],
            ['/report/list', 2, NULL, NULL, NULL, 1481625702, 1481625702],
            ['/report/save', 2, NULL, NULL, NULL, 1481634725, 1481634725],
            ['/report/update', 2, NULL, NULL, NULL, 1482044396, 1482044396],
            ['/report/view', 2, NULL, NULL, NULL, 1482939697, 1482939697],
            ['/site/index', 2, NULL, NULL, NULL, 1484062801, 1484062801],
            ['/subscription/delete', 2, NULL, NULL, NULL, 1482942675, 1482942675],
            ['/subscription/list', 2, NULL, NULL, NULL, 1482206718, 1482206718],
            ['/subscription/toggle', 2, NULL, NULL, NULL, 1482942345, 1482942345],
            ['/user/*', 2, NULL, NULL, NULL, 1481465291, 1481465291],
            ['基础操作', 2, '基础操作', NULL, NULL, 1484062850, 1484062850],
            ['报表的创建和编辑', 2, '报表的创建和编辑', NULL, NULL, 1481465540, 1482044402],
            ['数据库连接配置增删改查', 2, '数据库连接配置管理，可以进行增删改查', NULL, NULL, 1481464959, 1484214144],
            ['查看报表列表的权限', 2, '查看报表列表的权限', NULL, NULL, 1481625826, 1481625826],
            ['添加删除收藏', 2, '将报表加入到我的收藏和移除出去', NULL, NULL, 1482206758, 1482206758],
            [Yii::t('app', 'User'), 1, '不懂 SQL 只能使用报表', null, null, 1484214025, 1484214025],
            [Yii::t('app', 'Programmer'), 1, '懂 SQL 语句可以自己创建报表', null, null, 1484213989, 1484213989],
            [Yii::t('app', 'Administrator'), 1, '系统配置和维护', null, null, 1484214040, 1484214040],
            ['系统用户的增删改查', 2, '改系统用户的管理', NULL, NULL, 1481465342, 1481465342],
                ]
        );


        $this->batchInsert(
            '{{%auth_item_child}}',
            ['parent', 'child'],
            [
            ['数据库连接配置增删改查', '/database/*'],
            ['报表的创建和编辑', '/report/create'],
            ['查看报表列表的权限', '/report/export-by-id'],
            ['查看报表列表的权限', '/report/list'],
            ['报表的创建和编辑', '/report/save'],
            ['报表的创建和编辑', '/report/update'],
            ['查看报表列表的权限', '/report/view'],
            ['基础操作', '/site/index'],
            ['添加删除收藏', '/subscription/delete'],
            ['添加删除收藏', '/subscription/list'],
            ['添加删除收藏', '/subscription/toggle'],
            ['系统用户的增删改查', '/user/*'],
            ['管理员', '数据库连接配置增删改查'],
            ['程序员', '普通用户'],
            ['管理员', '程序员'],
            ['管理员', '系统用户的增删改查'],
                ]
        );


        $this->batchInsert(
            '{{%auth_assignment}}',
            ['item_name', 'user_id', 'created_at'],
            [
            ['基础操作', '1', 1484062861],
            ['报表的创建和编辑', '1', 1481465551],
            ['数据库连接配置增删改查', '1', 1481464985],
            ['查看报表列表的权限', '1', 1481625869],
            ['添加删除收藏', '1', 1482206802],
            ['系统用户的增删改查', '1', 1481465354],
                ]
        );

        $this->batchInsert(
            '{{%menu}}',
            ['id', 'name', 'parent', 'route', 'order', 'data'],
            [
            [1, Yii::t('app', 'Create Report'), null, '/report/create', 1, '{"icon": "fa fa-edit"}'],
            [2, Yii::t('app', 'Report List'), null, '/report/list', 2, '{"icon": "fa fa-list"}'],
                ]
        );
    }

    public function down()
    {
        $this->truncateTable('{{%auth_assignment}}');
        $this->truncateTable('{{%auth_item_child}}');
        $this->truncateTable('{{%auth_item}}');
    }
}
