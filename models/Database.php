<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;
use yii\db\Expression;

/**
 * This is the model class for table "database".
 *
 * @property integer $id
 * @property string  $alias
 * @property string  $type
 * @property string  $host
 * @property integer $port
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
            [['alias', 'type', 'host', 'port', 'database'], 'required'],
            [['id', 'deleted', 'created_at', 'updated_at'], 'safe'],
            [['host', 'database', 'username', 'password'], 'string', 'max' => 64],
            [['alias', 'charset'], 'string', 'max' => 32],
            [['type'], 'in', 'range' => ['mysql', 'pgsql'], 'strict' => true],
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
            'alias'      => Yii::t('app', 'Database Alias'),
            'type'       => Yii::t('app', 'Database Type'),
            'host'       => Yii::t('app', 'Host'),
            'port'       => Yii::t('app', 'Port'),
            'database'   => Yii::t('app', 'Database Name'),
            'username'   => Yii::t('app', 'User Name'),
            'password'   => Yii::t('app', 'Password'),
            'charset'    => Yii::t('app', 'Connection Charset'),
            'created_at' => Yii::t('app', 'Created Time'),
            'updated_at' => Yii::t('app', 'Last Updated Time'),
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

    public function getDsn()
    {
        $dsnTemplate = '%s:host=%s;port=%d;dbname=%s;user=%s;password=%s';
        return sprintf(
            $dsnTemplate,
            $this->type,
            $this->host,
            $this->port,
            $this->database,
            $this->username,
            '******'
        );
    }
}
