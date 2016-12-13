<?php

namespace app\controllers;

use app\models\Database;
use app\models\Report;
use app\models\SqlForm;
use Yii;
use yii\data\ActiveDataProvider;
use yii\db\Exception;
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
        $sqlForm   = new SqlForm();
        $results   = [];
        $exception = null;
        if (Yii::$app->request->getIsPost()) {
            $sqlForm->attributes = Yii::$app->request->post();
            try {
                $results = $sqlForm->execute();
            } catch (Exception $ex) {
                $exception = $ex;
            }
        }
        if (!isset($sqlForm->database_id)) {
            $sqlForm->database_id = key($dbDropdownOptions);
        }


        return $this->render(
            'create',
            [
              'sqlForm'           => $sqlForm,
              'dbDropdownOptions' => $dbDropdownOptions,
              'results'           => $results,
              'exception'         => $exception,
            ]
        );
    }

    public function actionSave()
    {
    }

    public function actionList()
    {

        $dataProvider = new ActiveDataProvider([
            'query' => Report::find(),
        ]);

        return $this->render('list', [
                'dataProvider' => $dataProvider,
        ]);
    }
}
