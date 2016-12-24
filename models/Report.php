<?php

namespace app\models;

use yii\behaviors\TimestampBehavior;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;
use yii\db\Expression;

/**
 * This is the model class for table "report".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $database_id
 * @property string  $name
 * @property string  $sql
 * @property string  $description
 * @property string  $created_at
 * @property string  $updated_at
 *
 * @property Database $database
 */
class Report extends ActiveRecord
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'report';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'database_id', 'name', 'sql'], 'required'],
            [['user_id', 'database_id'], 'integer'],
            [['sql', 'description'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['name'], 'string', 'max' => 32],
            [
                ['database_id'],
                'exist',
                'skipOnError'     => true,
                'targetClass'     => Database::className(),
                'targetAttribute' => ['database_id' => 'id']
            ],
        ];
    }

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'value' => new Expression('NOW()'),
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id'          => 'ID',
            'user_id'     => '创建人',
            'database_id' => '数据库',
            'name'        => '报表名称',
            'sql'         => '查询',
            'description' => '报表描述',
            'created_at'  => '创建时间',
            'updated_at'  => '最后更新时间',
        ];
    }

    /**
     * @return ActiveQuery
     */
    public function getDatabase()
    {
        return $this->hasOne(Database::className(), ['id' => 'database_id']);
    }

    /**
     * @return ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
    /**
     * @inheritdoc
     * @return ReportQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ReportQuery(get_called_class());
    }

    /**
     * Create a report model object and set values to fields according to
     * $attributes, and load default values to others if $loadDefaultValues is
     * true.
     *
     * @param array   $attributes
     * @param boolean $loadDefaultValues
     * @return \self
     */
    public static function initEmptyRecord($attributes = [], $loadDefaultValues = true)
    {
        $report = new self();
        foreach ($attributes as $name => $value) {
            $report->setAttribute($name, $value);
        }
        if ($loadDefaultValues) {
            $report->loadDefaultValues();
        }
        return $report;
    }
}
