<?php

namespace app\controllers;

use app\models\Database;
use app\models\SqlForm;
use Yii;
use yii\web\Controller;

/**
 * Description of ReportController
 *
 * @author charles
 */
class ReportController extends Controller
{

    public function actionEdit()
    {
        $dbDropdownOptions = Database::find()->dropdownOptions()->asArray()->column();
        $sqlForm           = new SqlForm();
        if (Yii::$app->request->isPost) {
            $sqlForm->attributes = Yii::$app->request->post();
        }
        return $this->render(
            'edit',
            [
                'sqlForm'           => $sqlForm,
                'dbDropdownOptions' => $dbDropdownOptions,
                ]
        );
    }
}
