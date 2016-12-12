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
        ];
    }

    public function execute()
    {
        $start_time = microtime(true);
        $database   = Database::findOne($this->database_id);
        /* @var $connection Connection */
        $connection = Yii::createObject([
              'class'    => 'yii\db\Connection',
              'dsn'      => 'mysql:host=' . $database->host . ';dbname=' . $database->database,
              'username' => $database->username,
              'password' => $database->password,
              'charset'  => $database->charset,
        ]);

        $errno = 0;
        try {
            $results = $connection->createCommand($this->sql)->queryAll();
        } catch (\Exception $ex) {
            $errno = $ex->getCode();
            throw $ex;
        } finally {
            $time_spent = microtime(true) - $start_time;
            Log::log(Yii::$app->user->id, $this->database_id, $this->sql, $time_spent, $errno);
        }

        return $results;
    }
}
