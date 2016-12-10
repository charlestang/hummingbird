<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Database]].
 *
 * @see Database
 */
class DatabaseQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return Database[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Database|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
