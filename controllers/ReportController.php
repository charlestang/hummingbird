<?php

namespace app\controllers;

use app\components\CsvHelper;
use app\models\Database;
use app\models\Report;
use app\models\SqlForm;
use Yii;
use yii\base\UserException;
use yii\data\ActiveDataProvider;
use yii\db\Exception;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

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
                    'save'                => ['post'],
                    'create'              => ['get', 'post'],
                    'edit'                => ['get', 'post'],
                    'export-query'        => ['post'],
                    'export-by-report-id' => ['post'],
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
                $results = $sqlForm->execute(30);
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

    /**
     * 保存报表
     */
    public function actionSave($id = null)
    {
        if ($id !== null) {
            $report = self::loadModel($id, Yii::$app->user->id);
        } else {
            $report = Report::initEmptyRecord(['user_id' => Yii::$app->user->id]);
        }
        $report->attributes = Yii::$app->request->post('Report');
        if (!$report->save()) {
            throw new UserException(var_export($report->getErrors(), true));
        }
        return $this->redirect(['list']);
    }

    private static function loadModel($id, $user_id)
    {
        $report = Report::findOne([
              'id'      => $id,
              'user_id' => $user_id,
        ]);
        if (null === $report) {
            throw new NotFoundHttpException('Report not found.');
        }

        return $report;
    }

    /**
     * 列出所有的报表
     */
    public function actionList()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Report::find(),
        ]);

        return $this->render(
            'list',
            [
              'dataProvider' => $dataProvider,
            ]
        );
    }

    public function actionUpdate($id)
    {
        $report               = self::loadModel($id, Yii::$app->user->id);
        $sqlForm              = new SqlForm();
        $sqlForm->sql         = $report->sql;
        $sqlForm->database_id = $report->database_id;
        //可供选择的数据库连接配置
        $dbDropdownOptions    = Database::find()->dropdownOptions()->asArray()->column();

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
            'edit',
            [
              'report'            => $report,
              'sqlForm'           => $sqlForm,
              'dbDropdownOptions' => $dbDropdownOptions,
              'results'           => $results,
              'exception'         => $exception,
            ]
        );
    }

    /**
     * 数据导出
     */
    public function actionExportQuery()
    {
        $sqlForm             = new SqlForm();
        $sqlForm->attributes = Yii::$app->request->post();
        CsvHelper::exportDataAsCsv($sqlForm->execute(), 'Query-' . date('YmdHis') . '.csv');
        return;
    }

    /**
     * 导出保存完毕的报表
     */
    public function actionExportByReportId()
    {
        $id     = Yii::$app->request->post('report_id');
        $report = Report::findOne(['id' => $id]);
        if (!empty($report)) {
            $sqlForm              = new SqlForm();
            $sqlForm->sql         = $report->sql;
            $sqlForm->database_id = $report->database_id;
        }
        $reportName = $report->name;
        CsvHelper::exportDataAsCsv($sqlForm->execute(), $reportName . '-' . date('YmdHis') . '.csv');
        return;
    }

    public function actionView($id)
    {
        $report = Report::findOne(['id' => $id]);
        if (!empty($report)) {
            $sqlForm              = new SqlForm();
            $sqlForm->sql         = $report->sql;
            $sqlForm->database_id = $report->database_id;
        }

        $exception = null;
        try {
            $results = $sqlForm->execute();
        } catch (Exception $ex) {
            $exception = $ex;
        }

        return $this->render(
            'report',
            [
              'sqlForm'   => $sqlForm,
              'results'   => $results,
              'exception' => $exception,
              'report'    => $report,
            ]
        );
    }
}
