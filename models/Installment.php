<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%installment}}".
 *
 * @property int $id
 * @property int $item_id
 * @property int $customer_id
 * @property string $date
 * @property string $cheque_number
 * @property int $notes
 * @property int $is_made_payment
 * @property int $total
 *
 * @property Customers $customer
 * @property Items $item
 */
class Installment extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return '{{%installment}}';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['item_id', 'customer_id', 'date', 'total'], 'required'],
            [['item_id', 'customer_id', 'is_made_payment', 'total'], 'integer'],
            [['date'], 'safe'],
            [['cheque_number'], 'string', 'max' => 20],
            [['notes',], 'string', 'max' => 250],
            [['customer_id'], 'exist', 'skipOnError' => true, 'targetClass' => Customers::className(), 'targetAttribute' => ['customer_id' => 'id']],
            [['item_id'], 'exist', 'skipOnError' => true, 'targetClass' => Items::className(), 'targetAttribute' => ['item_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => Yii::t('app', 'ID'),
            'item_id' => Yii::t('app', 'Item ID'),
            'customer_id' => Yii::t('app', 'Customer ID'),
            'date' => Yii::t('app', 'Date'),
            'cheque_number' => Yii::t('app', 'Cheque Number'),
            'notes' => Yii::t('app', 'Notes'),
            'is_made_payment' => Yii::t('app', 'Is Made Payment'),
            'total' => Yii::t('app', 'Total'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomer() {
        return $this->hasOne(Customers::className(), ['id' => 'customer_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserTotalInstallment() {
        return $this->find()->select(['sum(total)'])->where(['customer_id' => $this->customer_id])->scalar();
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserPaidInstallment() {
        return $this->find()->select(['sum(total)'])->where(['customer_id' => $this->customer_id, 'is_made_payment' => 1])->scalar();
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserUnPaidInstallment() {
        return $this->find()->select(['sum(total)'])->where(['customer_id' => $this->customer_id, 'is_made_payment' => 0])->scalar();
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserOverdueInstallment() {
        return $this->find()->select(['sum(total)'])->where(['customer_id' => $this->customer_id, 'is_made_payment' => 0])->andWhere(['<', 'date', date('Y-m-d') ])->scalar();
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItem() {
        return $this->hasOne(Items::className(), ['id' => 'item_id']);
    }

    /**
     * @inheritdoc
     * @return InstallmentQuery the active query used by this AR class.
     */
    public static function find() {
        return new InstallmentQuery(get_called_class());
    }

}
