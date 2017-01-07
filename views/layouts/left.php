<?php

use app\components\FavMenuHelper;
use app\components\MenuHelper as MyMenuHelper;
use dmstr\widgets\Menu;
use mdm\admin\components\MenuHelper;
?>
<aside class="main-sidebar">

    <section class="sidebar" id="lsidebar">

        <!-- search form -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control search" placeholder="Search..."/>
                <span class="input-group-btn">
                    <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i>
                    </button>
                </span>
            </div>
        </form>
        <!-- /.search form -->
        <?=
        Menu::widget([
            'options' => ['class' => 'sidebar-menu'],
            'items' => MenuHelper::getAssignedMenu(\Yii::$app->user->id, null, MyMenuHelper::getMenuItemParser()),
        ])
        ?>
        <?=
        Menu::widget([
            'options' => ['class' => 'sidebar-menu'],
            'linkTemplate' => '<a class="report-name" href="{url}">{icon} {label}</a>',
            'items' => FavMenuHelper::getFavMenuItems(),
        ])
        ?>

        <?php
        $listjs = <<<JS
        var lss_options = {
            listClass : 'treeview-menu',
            valueNames: [
                'report-name'
            ]
        };
        var left_sidebar_search = new List('lsidebar', lss_options);
JS;
        $this->registerJs($listjs);
        ?>

    </section>

</aside>
