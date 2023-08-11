#!/bin/sh
/var/www/hummingbird/yii migrate --interactive=0 --migrationPath=@yii/rbac/migrations \
    && /var/www/hummingbird/yii migrate --interactive=0 --migrationPath=@mdm/admin/migrations \
    && /var/www/hummingbird/yiii migrate/up
apache2-foreground