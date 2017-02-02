<?php

return [
    'admin' => [
        'class'         => 'mdm\admin\Module',
        'layout'        => 'left-menu',
        'mainLayout'    => '@app/views/layouts/main.php',
        'controllerMap' => [
            'assignment' => [
                'class'        => 'mdm\admin\controllers\AssignmentController',
                'extraColumns' => [[
                'class' => '\yii\grid\DataColumn',
                'label' => 'Roles',
                'value' => function($user) {
                    $roles = Yii::$app->authManager->getRolesByUser($user->id);
                    return empty($roles) ? '' : implode(',', array_map(function($arrItem) {
                                                return $arrItem->name;
                                            }, $roles));
                }
                    ]],
            ],
        ],
    ],
];
