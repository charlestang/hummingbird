<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\db\Connection;

/**
 * Description of SqlForm
 *
 * @author charles
 */
class SqlForm extends Model
{

    public $sql = '';
    public $database_id;

    public function rules()
    {
        return [
            [['sql', 'database_id'], 'required'],
            ['sql', 'trim'],
            ['database_id', 'integer'],
        ];
    }

    /**
     * 净化SQL语句 
     * @param  string $sql
     * @return string sanitized sql statement
     */
    public static function sanitize($sql)
    {
        return str_replace(["\r", "\n"], " ", trim(trim($sql), ';'));
    }

    public function execute()
    {
        if (!$this->validate()) {
            throw new \yii\base\UserException('错误:' . var_export($this->getErrors(), true), 400);
        }
        $start_time = microtime(true);
        $connection = static::createDbConnection($this->database_id);

        $errno = 0;
        $sql   = static::sanitize($this->sql);
        try {
            $results = $connection->createCommand($sql)->queryAll();
        } catch (\Exception $ex) {
            $errno = $ex->getCode();
            throw $ex;
        } finally {
            $time_spent = microtime(true) - $start_time;
            Log::log(Yii::$app->user->id, $this->database_id, $sql, $time_spent, $errno);
        }

        return $results;
    }

    public static function createDbConnection($database_id)
    {
        $database   = Database::findOne($database_id);
        /* @var $connection Connection */
        $connection = Yii::createObject([
              'class'    => 'yii\db\Connection',
              'dsn'      => 'mysql:host=' . $database->host . ';dbname=' . $database->database,
              'username' => $database->username,
              'password' => $database->password,
              'charset'  => $database->charset,
        ]);

        return $connection;
    }
}
