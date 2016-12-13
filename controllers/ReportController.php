<?php

namespace app\controllers;

use app\models\Database;
use app\models\Report;
use app\models\SqlForm;
use Yii;
use yii\data\ActiveDataProvider;
use yii\db\Exception;
use yii\filters\VerbFilter;
use yii\web\Controller;

/**
 * Description of ReportController
 *
 * @author charles
 */
class ReportController extends Controller
{

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class'   => VerbFilter::className(),
                'actions' => [
                    'save' => ['post'],
                    'create' => ['get', 'post'],
                ],
            ],
        ];
    }

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
        $report = new Report();
        $report->loadDefaultValues();
        $request = Yii::$app->request;
        $report->name = $request->post('name');
        $report->description= $request->post('description');
        $report->sql = $request->post('sql');
        $report->database_id = $request->post('database_id');
        $report->user_id = Yii::$app->user->id;
        $report->save();
        return $this->redirect(['list']);
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
