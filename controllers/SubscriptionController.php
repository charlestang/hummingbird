<?php

namespace app\controllers;

use app\models\Subscription;
use yii\data\ActiveDataProvider;
use yii\web\Controller;

/**
 * Description of SubscriptionController
 *
 * @author charles
 */
class SubscriptionController extends Controller
{
    public function actionList()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Subscription::find(),
        ]);

        return $this->render('list', [
              'dataProvider' => $dataProvider,
        ]);
    }
}
