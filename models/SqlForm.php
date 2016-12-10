<?php

namespace app\models;

use yii\base\Model;

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
}
