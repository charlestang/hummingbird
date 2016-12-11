<?php

namespace app\models;

use app\models\Database;
use app\models\LogQuery;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;
use yii\db\Expression;

/**
 * This is the model class for table "log".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $database_id
 * @property string  $sql
 * @property string  $created_at
 * @property string  $updated_at
 *
 * @property Database $database
 */
class Log extends ActiveRecord
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'log';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'database_id', 'sql'], 'required'],
            [['user_id', 'database_id'], 'integer'],
            [['sql'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['database_id'], 'exist', 'skipOnError' => true, 'targetClass' => Database::className(), 'targetAttribute' => ['database_id' => 'id']],
        ];
    }

    public function behaviors()
    {
        return [
            [
                'class'              => TimestampBehavior::className(),
                'value'              => new Expression('NOW()'),
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
            'user_id'     => 'user who executed this sql',
            'database_id' => 'Database ID',
            'sql'         => 'Sql',
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
     * @return LogQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new LogQuery(get_called_class());
    }
}
