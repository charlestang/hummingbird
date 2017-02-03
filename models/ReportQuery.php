<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Report]].
 *
 * @see Report
 */
class ReportQuery extends \yii\db\ActiveQuery
{

    /**
     * @inheritdoc
     * @return Report[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Report|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    public function valid()
    {
        return $this->andWhere('deleted=0');
    }
}
