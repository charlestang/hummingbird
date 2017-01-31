<?php

namespace app\models;

use app\models\Database;
use app\models\Log;
use PhpMyAdmin\SqlParser\Components\Limit;
use PhpMyAdmin\SqlParser\Parser;
use PhpMyAdmin\SqlParser\Utils\Formatter;
use UnexpectedValueException;
use Yii;
use yii\base\Model;
use yii\base\UserException;
use yii\db\Connection;

/**
 * SqlForm is designed for SQL execution.
 * 
 * Every SQL will be processed after following steps:
 * - pre-process  replace variables by default value or given value
 * - validate     check if the SQL is read only
 * - run          send the SQL to server and retrieve the results
 * - post-process format the result
 *
 * @author charles
 */
class SqlForm extends Model
{

    public $sql        = '';
    public $database_id;
    public $time_spent = 0;

    protected $compiled_sql = '';
    protected $parameters = [];
    protected $values = [];

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
        $parser = new Parser($sql);
        return $parser;
    }

    protected function run($limit = false)
    {
        $start_time = microtime(true);
        $connection = static::createDbConnection($this->database_id);

        $errno        = 0;
        $parser       = $this->parse($this->compiled_sql);
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
            $this->time_spent = microtime(true) - $start_time;
            Log::log(Yii::$app->user->id, $this->database_id, $this->sql, $this->time_spent, $errno);
        }

        return $results;
    }

    /**
     * Pre-process the SQL
     * @return boolean
     * @throws UserException
     */
    protected function preProcess()
    {
        $this->compiled_sql = $this->sql;
        $ret = preg_match('#/\*.*\*/#ms', $this->compiled_sql, $matches);
        if ($ret) {
            $lines     = array_map('trim', explode("\n", $matches[0]));
            list($names, $defaults) = $this->parseParameters($lines);
            $this->compiled_sql = str_replace($matches[0], '', $this->compiled_sql);
            $this->compiled_sql = str_replace($names, $defaults, $this->compiled_sql);
        }
        return true;
    }

    protected function parseParameters($lines)
    {
        $names    = [];
        $defaults = [];
        foreach ($lines as $line) {
            if (strpos($line, '@var') === 0) {
                $parts      = array_map('trim', explode(' ', $line, 4));
                $names[]    = $parts[2];
                $defaults[] = $parts[3];
            }
        }
        return [$names, $defaults];
    }

    public function execute($limit = false)
    {
        $this->preProcess();

        if (!$this->validate()) {
            throw new UserException('错误:' . var_export($this->getErrors(), true), 400);
        }

        $results = $this->run($limit);

        return $this->filter($results);
    }

    protected function filter($results)
    {
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
            'PhpMyAdmin\SqlParser\Statements\SelectStatement',
            'PhpMyAdmin\SqlParser\Statements\ExplainStatement',
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
