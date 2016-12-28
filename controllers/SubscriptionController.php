<?php

namespace app\controllers;

use app\models\Subscription;
use Yii;
use yii\base\UserException;
use yii\data\ActiveDataProvider;
use yii\web\Controller;

/**
 * Description of SubscriptionController
 *
 * @author charles
 */
class SubscriptionController extends Controller {

    public function actionList() {
        $dataProvider = new ActiveDataProvider([
            'query' => Subscription::find([
                'user_id' => Yii::$app->user->id,
            ]),
        ]);

        return $this->render('list', [
                    'dataProvider' => $dataProvider,
        ]);
    }

    public function actionToggle($report_id) {
        $user_id = Yii::$app->user->id;
        if (Subscription::isSubscribed($user_id, $report_id)) {
            $ret = Subscription::unsubscribe($user_id, $report_id);
        } else {
            $ret = Subscription::subscribe($user_id, $report_id);
        }

        if ($ret) {
            return $this->redirect(['/report/list']);
        } else {
            throw new UserException('Unkonwn exception!');
        }
    }

    public function actionDelete($id) {
        $subscription = Subscription::findOne($id);

        if (($subscription && $subscription->delete()) || !$subscription) {
            return $this->redirect(['list']);
        } else {
            throw new UserException('Unkonwn exception!');
        }
    }

}
