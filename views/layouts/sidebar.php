<?php
use yii\helpers\Url;
?>
<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
    <div class="tab-content">
        <h3 class="control-sidebar-heading">系统管理</h3>
        <ul class='control-sidebar-menu'>
            <li>
                <a href='<?= Url::to('/database/index') ?>'>
                    <i class="menu-icon fa fa-database bg-red"></i>

                    <div class="menu-info">
                        <h4 class="control-sidebar-subheading">数据库配置</h4>

                        <p>哪些数据库连接可供查询</p>
                    </div>
                </a>
            </li>
            <li>
                <a href='<?= Url::to('/subscription/list') ?>'>
                    <i class="menu-icon fa fa-star bg-green"></i>

                    <div class="menu-info">
                        <h4 class="control-sidebar-subheading">管理我的收藏</h4>

                        <p>管理我的收藏夹</p>
                    </div>
                </a>
            </li>
            <li>
                <a href='<?=Url::to('/user/index')?>'>
                    <i class="menu-icon fa fa-user bg-yellow"></i>

                    <div class="menu-info">
                        <h4 class="control-sidebar-subheading">用户管理</h4>

                        <p>用户管理系统</p>
                    </div>
                </a>
            </li>
            <li>
                <a href='<?= Url::to('/admin') ?>'>
                    <i class="menu-icon fa fa-key bg-blue"></i>

                    <div class="menu-info">
                        <h4 class="control-sidebar-subheading">权限管理</h4>

                        <p>基于角色的访问控制</p>
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
