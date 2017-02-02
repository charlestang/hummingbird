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
            ['/admin/*', 2, null, null, null, 1486628860, 1486628860],
            ['/database/create', 2, null, null, null, 1486627812, 1486627812],
            ['/database/delete', 2, null, null, null, 1486627815, 1486627815],
            ['/database/index', 2, null, null, null, 1486627810, 1486627810],
            ['/database/update', 2, null, null, null, 1486627814, 1486627814],
            ['/report/create', 2, null, null, null, 1481465517, 1481465517],
            ['/report/export-by-id', 2, null, null, null, 1483001009, 1483001009],
            ['/report/list', 2, null, null, null, 1481625702, 1481625702],
            ['/report/save', 2, null, null, null, 1481634725, 1481634725],
            ['/report/update', 2, null, null, null, 1482044396, 1482044396],
            ['/report/view', 2, null, null, null, 1482939697, 1482939697],
            ['/site/index', 2, null, null, null, 1484062801, 1484062801],
            ['/subscription/delete', 2, null, null, null, 1482942675, 1482942675],
            ['/subscription/list', 2, null, null, null, 1482206718, 1482206718],
            ['/subscription/toggle', 2, null, null, null, 1482942345, 1482942345],
            ['/user/*', 2, null, null, null, 1481465291, 1481465291],
            ['基础操作', 2, '基础操作', null, null, 1484062850, 1484062850],
            ['报表的列表', 2, '列出系统里已经创建好的报表', null, null, 1486628422, 1486628422],
            ['报表的创建', 2, '创建报表', null, null, 1481465540, 1486628296],
            ['报表的增、删、改、查以及导出', 2, '报表的增删改查和导出功能', null, null, 1486628477, 1486628477],
            ['报表的查看、导出', 2, '系统里已有的具体报表的内容查看', null, null, 1481625826, 1486628509],
            ['报表的编辑', 2, '编辑系统里的报表', null, null, 1486628326, 1486628326],
            ['收藏夹的添加、删除、罗列', 2, '将报表加入到我的收藏和移除出去', null, null, 1482206758, 1486628637],
            ['数据库配置列表', 2, '列出系统里可被查询的数据库配置', null, null, 1486627846, 1486627886],
            ['数据库配置创建', 2, '数据库连接配置管理，可以创建数据库配置', null, null, 1481464959, 1486627917],
            ['数据库配置删除', 2, '逻辑删除系统里存在的数据库配置', null, null, 1486627978, 1486627978],
            ['数据库配置更新', 2, '更新系统里已经有的数据库配置', null, null, 1486627954, 1486627954],
            ['数据库配置的增、删、改、查', 2, '可以对系统里的数据库配置进行增删改查', null, null, 1486628091, 1486628129],
            ['权限管理系统', 2, '权限管理系统的功能', null, null, 1486628885, 1486628885],
            [Yii::t('app', 'User'), 1, '不懂 SQL 只能使用报表', null, null, 1484214025, 1484214025],
            [Yii::t('app', 'Programmer'), 1, '懂 SQL 语句可以自己创建报表', null, null, 1484213989, 1484213989],
            [Yii::t('app', 'Administrator'), 1, '系统配置和维护', null, null, 1484214040, 1484214040],
            ['系统用户的增删改查', 2, '改系统用户的管理', null, null, 1481465342, 1481465342],
                ]
        );


        $this->batchInsert(
            '{{%auth_item_child}}',
            ['parent', 'child'],
            [
            ['权限管理系统', '/admin/*'],
            ['数据库配置创建', '/database/create'],
            ['数据库配置删除', '/database/delete'],
            ['数据库配置列表', '/database/index'],
            ['数据库配置更新', '/database/update'],
            ['报表的创建', '/report/create'],
            ['报表的查看、导出', '/report/export-by-id'],
            ['报表的列表', '/report/list'],
            ['报表的创建', '/report/save'],
            ['报表的编辑', '/report/save'],
            ['报表的编辑', '/report/update'],
            ['报表的查看、导出', '/report/view'],
            ['基础操作', '/site/index'],
            ['收藏夹的添加、删除、罗列', '/subscription/delete'],
            ['收藏夹的添加、删除、罗列', '/subscription/list'],
            ['收藏夹的添加、删除、罗列', '/subscription/toggle'],
            ['系统用户的增删改查', '/user/*'],
            ['报表的增、删、改、查以及导出', '报表的列表'],
            ['报表的增、删、改、查以及导出', '报表的创建'],
            ['报表的增、删、改、查以及导出', '报表的查看、导出'],
            ['报表的增、删、改、查以及导出', '报表的编辑'],
            ['数据库配置的增、删、改、查', '数据库配置列表'],
            ['数据库配置的增、删、改、查', '数据库配置创建'],
            ['数据库配置的增、删、改、查', '数据库配置删除'],
            ['数据库配置的增、删、改、查', '数据库配置更新'],
            [Yii::t('app', 'User'), '报表的查看、导出'],
            [Yii::t('app', 'User'), '收藏夹的添加、删除、罗列'],
            [Yii::t('app', 'Programmer'), '报表的增、删、改、查以及导出'],
            [Yii::t('app', 'Programmer'), Yii::t('app', 'User')],
            [Yii::t('app', 'Administrator'), '数据库配置的增、删、改、查'],
            [Yii::t('app', 'Administrator'), '权限管理系统'],
            [Yii::t('app', 'Administrator'), Yii::t('app', 'Programmer')],
            [Yii::t('app', 'Administrator'), '系统用户的增删改查'],
                ]
        );


        $this->batchInsert(
            '{{%auth_assignment}}',
            ['item_name', 'user_id', 'created_at'],
            [
            [Yii::t('app', 'Administrator'), '1', 1486628774],
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
