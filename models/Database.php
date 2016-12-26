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
 * @property string  $deleted
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
            [['id', 'deleted', 'created_at', 'updated_at'], 'safe'],
            [['host', 'database', 'username', 'password'], 'string', 'max' => 64],
            [['alias', 'charset'], 'string', 'max' => 32],
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
            'id'         => 'ID',
            'alias'      => '别名',
            'host'       => '主机',
            'database'   => '数据库名',
            'username'   => '用户名',
            'password'   => '密码',
            'charset'    => '连接字符集',
            'created_at' => '添加时间',
            'updated_at' => '更新时间',
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

    /**
     * @inheritdoc
     * @return false|int
     */
    public function delete()
    {
        $this->deleted = 1;
        return $this->update(false, ['deleted']);
    }
}
