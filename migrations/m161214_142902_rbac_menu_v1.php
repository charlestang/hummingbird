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
            ['/database/*', 2, null, null, null, 1481464892, 1481464892],
            ['/report/create', 2, null, null, null, 1481465517, 1481465517],
            ['/report/list', 2, null, null, null, 1481625702, 1481625702],
            ['/report/save', 2, null, null, null, 1481634725, 1481634725],
            ['/report/update', 2, null, null, null, 1482044396, 1482044396],
            ['/subscription/add', 2, null, null, null, 1482206779, 1482206779],
            ['/subscription/list', 2, null, null, null, 1482206718, 1482206718],
            ['/user/*', 2, null, null, null, 1481465291, 1481465291],
            ['报表的创建和编辑', 2, '报表的创建和编辑', null, null, 1481465540, 1482044402],
            ['数据库连接配置增删改查', 2, '数据库连接配置管理，可以进行增删改查', null, null, 1481464959, 1481464959],
            ['查看报表列表的权限', 2, '查看报表列表的权限', null, null, 1481625826, 1481625826],
            ['添加删除收藏', 2, '将报表加入到我的收藏和移除出去', null, null, 1482206758, 1482206758],
            ['系统用户的增删改查', 2, '改系统用户的管理', null, null, 1481465342, 1481465342],
            ]
        );


        $this->batchInsert(
            '{{%auth_item_child}}',
            ['parent', 'child'],
            [
            ['数据库连接配置增删改查', '/database/*'],
            ['报表的创建和编辑', '/report/create'],
            ['报表的创建和编辑', '/report/list'],
            ['查看报表列表的权限', '/report/list'],
            ['报表的创建和编辑', '/report/save'],
            ['报表的创建和编辑', '/report/update'],
            ['添加删除收藏', '/subscription/add'],
            ['添加删除收藏', '/subscription/list'],
            ['系统用户的增删改查', '/user/*'],
            ]
        );


        $this->batchInsert(
            '{{%auth_assignment}}',
            ['item_name', 'user_id', 'created_at'],
            [
            ['报表的创建和编辑', '1', 1481465551],
            ['数据库连接配置增删改查', '1', 1481464985],
            ['查看报表列表的权限', '1', 1481625869],
            ['系统用户的增删改查', '1', 1481465354],
            ['添加删除收藏', '1', 1482206802],
            ]
        );

        $this->batchInsert(
            '{{%menu}}',
            ['id', 'name', 'parent', 'route', 'order', 'data'],
            [
            [1, '创建报表', null, '/report/create', 1, '{"icon": "fa fa-edit"}'],
            [2, '报表一览', null, '/report/list', 2, '{"icon": "fa fa-list"}'],
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
