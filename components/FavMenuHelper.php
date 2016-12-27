<?php

namespace app\components;

use app\models\Subscription;
use Yii;

/**
 * Description of FavMenuHelper
 *
 * @author charles
 */
class FavMenuHelper
{

    public static function getFavMenuItems()
    {
        $result = [
            [
                'label' => '我的收藏',
                'icon'  => 'fa fa-star',
                'url'   => ['/subscription/list'],
                'items' => [],
            ],
        ];

        $subscriptions = Subscription::findAll(['user_id' => Yii::$app->user->id]);
        foreach ($subscriptions as $s) {
            $result[0]['items'][] = [
                'label' => $s->report->name,
                'icon'  => 'fa fa-circle',
                'url'   => ['/report/view', 'id' => $s->report_id],
            ];
        }

        return $result;
    }
}
