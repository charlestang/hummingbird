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

    /**
     * SQL statement
     * @var string
     */
    public $sql = '';

    /**
     * Database connection configuration ID
     * @var int
     */
    public $database_id;

    /**
     * Parameters name and value array.
     * @var array
     */
    protected $parameters = [];

    /**
     * @var float
     */
    protected $time_spent = 0;

    /**
     * SQL statement without comments
     * @var string
     */
    protected $sanitized_sql = '';

    /**
     * If the SQL statement is parameterized or not.
     * @var boolean
     */
    protected $parameterized = false;

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
        $parser       = $this->parse($this->sanitized_sql);
        $sqlStatement = $parser->statements[0];
        try {
            if ($limit) {
                $sqlStatement->limit = new Limit($limit);
            }
            $sql     = $sqlStatement->build();
            $results = $connection->createCommand($sql, array_map(function ($item) {
                return $item['default'];
            }, $this->parameters))->queryAll();
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
        $this->sanitized_sql = $this->sql;
        $comments = $this->extractAllComments($this->sql);
        $this->sanitized_sql = str_replace($comments, '', $this->sanitized_sql);

        $parameter_keys = $this->parseParameters($comments);
        $this->parameterized = !empty($parameter_keys);

        if ($this->parameterized) {
        }

        return true;
    }

    protected function extractAllComments($sql)
    {
        $matches = [];
        $multi_line_comments = [];
        $hash_leading_comments = [];
        $dash_leading_comments = [];
        if (preg_match_all('#/\*.*\*/#Ums', $sql, $matches)) {
            $multi_line_comments = $matches[0];
            $sql = str_replace($multi_line_comments, '', $sql);
        }
        if (preg_match_all('/#.*$/m', $sql, $matches)) {
            $hash_leading_comments = $matches[0];
            $sql = str_replace($hash_leading_comments, '', $sql);
        }
        if (preg_match_all('/--\s?.*$/m', $sql, $matches)) {
            $dash_leading_comments = $matches[0];
        }
        return array_merge($multi_line_comments, $hash_leading_comments, $dash_leading_comments);
    }

    /**
     * Parse the parameters from comments
     * @param array $comments
     * @return array the parameters' key array
     */
    protected function parseParameters($comments)
    {
        //break lines
        $lines   = [];
        while ($comment = array_shift($comments)) {
            $without_leading = preg_replace('/^(#\s*)|(--\s*)/', '', $comment);
            $lines           = array_merge($lines, array_map('trim', explode("\n", $without_leading)));
        }
        foreach ($lines as $line) {
            if (strpos($line, '@var') === 0) {
                $parts = array_map('trim', preg_split('/\s+/', $line, 4));
                $this->parameters[$parts[2]] = [
                    'type'    => trim($parts[1]),
                    'default' => trim($parts[3], '\'"'),
                ];
            }
        }
        return array_keys($this->parameters);
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

    public function getTimeSpent()
    {
        return $this->time_spent;
    }

    public function getParameters()
    {
        return $this->parameters;
    }
}
