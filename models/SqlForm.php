<?php

namespace app\models;

use app\models\Database;
use app\models\Log;
use SqlParser\Components\Limit;
use SqlParser\Parser;
use SqlParser\Utils\Formatter;
use UnexpectedValueException;
use Yii;
use yii\base\Model;
use yii\base\UserException;
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
            ['sql', 'validateSql'],
        ];
    }

    public function parse($sql)
    {
        $cacheKey = md5($sql);
        $parser   = Yii::$app->cache->get($cacheKey);
        if (false !== $parser) {
            return $parser;
        }

        $parser = new Parser($sql);
        Yii::$app->cache->set($cacheKey, $parser);
        return $parser;
    }

    public function execute($limit = false)
    {
        if (!$this->validate()) {
            throw new UserException('错误:' . var_export($this->getErrors(), true), 400);
        }
        $start_time = microtime(true);
        $connection = static::createDbConnection($this->database_id);

        $errno        = 0;
        $parser       = $this->parse($this->sql);
        $sqlStatement = $parser->statements[0];
        try {
            if ($limit) {
                $sqlStatement->limit = new Limit($limit);
            }
            $sql     = $sqlStatement->build();
            $results = $connection->createCommand($sql)->queryAll();
        } catch (\Exception $ex) {
            $errno = $ex->getCode();
            throw $ex;
        } finally {
            $time_spent = microtime(true) - $start_time;
            Log::log(Yii::$app->user->id, $this->database_id, $this->sql, $time_spent, $errno);
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

    public function validateSql($attribute, $params)
    {
        if ('sql' !== $attribute) {
            throw new UnexpectedValueException("This validator cannot be used on attribute other than 'sql'!");
        }
        $parser = $this->parse($this->sql);
        if (count($parser->statements) > 1) {
            throw new UnexpectedValueException("You should put only one SQL in your query request");
        }

        $type    = get_class($parser->statements[0]);
        $allowed = [
            'SqlParser\Statements\SelectStatement',
            'SqlParser\Statements\ExplainStatement',
        ];
        if (!in_array($type, $allowed)) {
            throw new UnexpectedValueException("You cannot execute this query");
        }
    }

    public function getBeautifiedVersion()
    {
        return Formatter::format($this->sql, ['type' => 'html']);
    }
}
