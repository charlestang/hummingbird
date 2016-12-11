<?php

namespace app\models;

use yii\behaviors\TimestampBehavior;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;
use yii\db\Expression;

/**
 * This is the model class for table "database".
 *
 * @property integer $id
 * @property string  $alias
 * @property string  $host
 * @property string  $database
 * @property string  $username
 * @property string  $password
 * @property string  $charset
 * @property string  $created_at
 * @property string  $updated_at
 *
 * @property Report[] $reports
 */
class Database extends ActiveRecord
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'database';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['alias', 'host', 'database'], 'required'],
            [['id', 'created_at', 'updated_at'], 'safe'],
            [['host', 'database', 'username', 'password'], 'string', 'max' => 64],
            [['alias', 'charset'], 'string', 'max' => 32],
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
            'id'         => 'ID',
            'alias'      => 'Alias',
            'host'       => 'Host',
            'database'   => 'DB Name',
            'username'   => 'Username',
            'password'   => 'Password',
            'charset'    => 'Charset',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return ActiveQuery
     */
    public function getReports()
    {
        return $this->hasMany(Report::className(), ['database_id' => 'id']);
    }

    /**
     * @inheritdoc
     * @return DatabaseQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new DatabaseQuery(get_called_class());
    }
}
