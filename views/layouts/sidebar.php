
<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
    <div class="tab-content">
        <h3 class="control-sidebar-heading">System Management</h3>
        <ul class='control-sidebar-menu'>
            <li>
                <a href='<?= yii\helpers\Url::to(['database/index']) ?>'>
                    <i class="menu-icon fa fa-database bg-red"></i>

                    <div class="menu-info">
                        <h4 class="control-sidebar-subheading">Database Configurations</h4>

                        <p>Manage db connections</p>
                    </div>
                </a>
            </li>
            <li>
                <a href='javascript::;'>
                    <i class="menu-icon fa fa-user bg-yellow"></i>

                    <div class="menu-info">
                        <h4 class="control-sidebar-subheading">User Management</h4>

                        <p>Manage users</p>
                    </div>
                </a>
            </li>
        </ul>
        <!-- /.control-sidebar-menu -->

        <h3 class="control-sidebar-heading">Tasks Progress</h3>
        <ul class='control-sidebar-menu'>
            <li>
                <a href='javascript::;'>
                    <h4 class="control-sidebar-subheading">
                        Custom Template Design
                        <span class="label label-danger pull-right">70%</span>
                    </h4>

                    <div class="progress progress-xxs">
                        <div class="progress-bar progress-bar-danger" style="width: 70%"></div>
                    </div>
                </a>
            </li>
            <li>
                <a href='javascript::;'>
                    <h4 class="control-sidebar-subheading">
                        Update Resume
                        <span class="label label-success pull-right">95%</span>
                    </h4>

                    <div class="progress progress-xxs">
                        <div class="progress-bar progress-bar-success" style="width: 95%"></div>
                    </div>
                </a>
            </li>
            <li>
                <a href='javascript::;'>
                    <h4 class="control-sidebar-subheading">
                        Laravel Integration
                        <span class="label label-waring pull-right">50%</span>
                    </h4>

                    <div class="progress progress-xxs">
                        <div class="progress-bar progress-bar-warning" style="width: 50%"></div>
                    </div>
                </a>
            </li>
            <li>
                <a href='javascript::;'>
                    <h4 class="control-sidebar-subheading">
                        Back End Framework
                        <span class="label label-primary pull-right">68%</span>
                    </h4>

                    <div class="progress progress-xxs">
                        <div class="progress-bar progress-bar-primary" style="width: 68%"></div>
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