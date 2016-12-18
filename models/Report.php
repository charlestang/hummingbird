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
            'id'          => 'id',
            'user_id'     => 'Creator',
            'database_id' => 'Database',
            'name'        => 'Name',
            'sql'         => 'Sql',
            'description' => 'Description',
            'created_at'  => 'Created At',
            'updated_at'  => 'Updated At',
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
            $report->setAttribute($name , $value);
        }
        if ($loadDefaultValues) {
            $report->loadDefaultValues();
        }
        return $report;
    }

}
