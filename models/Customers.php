<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%customers}}".
 *
 * @property int $id
 * @property string $name
 * @property int $status
 *
 * @property Installment[] $installments
 * @property Items[] $items
 */
class Customers extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%customers}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'status'], 'required'],
            [['status'], 'integer'],
            [['name'], 'string', 'max' => 250],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'status' => Yii::t('app', 'Status'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInstallments()
    {
        return $this->hasMany(Installment::className(), ['customer_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItems()
    {
        return $this->hasMany(Items::className(), ['sold_to' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return CustomersQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CustomersQuery(get_called_class());
    }
}
