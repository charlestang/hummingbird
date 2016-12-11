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

    /**
     * 新创建报表
     */
    public function actionCreate()
    {
        //可供选择的数据库连接配置
        $dbDropdownOptions = Database::find()->dropdownOptions()->asArray()->column();

        //查询
        $sqlForm = new SqlForm();
        if (Yii::$app->request->getIsPost()) {
            $sqlForm->attributes = Yii::$app->request->post();
        }
        if (!isset($sqlForm->database_id)) {
            $sqlForm->database_id = key($dbDropdownOptions);
        }

        return $this->render(
            'create',
            [
                'sqlForm'           => $sqlForm,
                'dbDropdownOptions' => $dbDropdownOptions,
                ]
        );
    }

    public function actionEdit()
    {
    }
}
