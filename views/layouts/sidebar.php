<?php

use yii\helpers\Url;
?>
<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
    <div class="tab-content">
        <h3 class="control-sidebar-heading"><?= Yii::t('app', 'System Management') ?></h3>
        <ul class='control-sidebar-menu'>
            <li>
                <a href='<?= Url::to('/database/index') ?>'>
                    <i class="menu-icon fa fa-database bg-red"></i>

                    <div class="menu-info">
                        <h4 class="control-sidebar-subheading"><?= Yii::t('app', 'Database Management') ?></h4>

                        <p><?= Yii::t('app', 'Databases can be query') ?></p>
                    </div>
                </a>
            </li>
            <li>
                <a href='<?= Url::to('/subscription/list') ?>'>
                    <i class="menu-icon fa fa-star bg-green"></i>

                    <div class="menu-info">
                        <h4 class="control-sidebar-subheading"><?= Yii::t('app', 'Favorite Management') ?></h4>

                        <p><?= Yii::t('app', 'Manage your favorite list') ?></p>
                    </div>
                </a>
            </li>
            <li>
                <a href='<?= Url::to('/user/index') ?>'>
                    <i class="menu-icon fa fa-user bg-yellow"></i>

                    <div class="menu-info">
                        <h4 class="control-sidebar-subheading"><?= Yii::t('app', 'User Management') ?></h4>

                        <p><?= Yii::t('app', 'Add or remove users') ?></p>
                    </div>
                </a>
            </li>
            <li>
                <a href='<?= Url::to('/admin') ?>'>
                    <i class="menu-icon fa fa-key bg-blue"></i>

                    <div class="menu-info">
                        <h4 class="control-sidebar-subheading"><?= Yii::t('app', 'Authorization') ?></h4>

                        <p><?= Yii::t('app', 'Role based authorization control') ?></p>
                    </div>
                </a>
            </li>
        </ul>
        <!-- /.control-sidebar-menu -->

    </div>
</aside><!-- /.control-sidebar -->
<!-- Add the sidebar's background. This div must be placed
     immediately after the control sidebar -->
<div class='control-sidebar-bg'></div>
