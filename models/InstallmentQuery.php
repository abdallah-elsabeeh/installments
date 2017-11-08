<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Installment]].
 *
 * @see Installment
 */
class InstallmentQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return Installment[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Installment|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
