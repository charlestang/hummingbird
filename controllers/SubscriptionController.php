<?php

namespace app\controllers;

use app\models\Subscription;
use Yii;
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
            'query' => Subscription::find([
                'user_id' => Yii::$app->user->id,
            ]),
        ]);

        return $this->render('list', [
              'dataProvider' => $dataProvider,
        ]);
    }

    public function actionAdd($report_id)
    {
        $subscription            = new Subscription();
        $subscription->loadDefaultValues();
        $subscription->user_id   = Yii::$app->user->id;
        $subscription->report_id = $report_id;
        $ret                     = $subscription->save();
        if ($ret) {
            return $this->redirect(['list']);
        } else {
            throw new \yii\base\UserException('Unkonwn exception!');
        }
    }
}
