<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Invoice;
use app\models\Customers;

/* @var $this yii\web\View */
/* @var $model app\models\Items */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="items-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput() ?>

    <?= $form->field($model, 'cost')->textInput() ?>

    <?= $form->field($model, 'price')->textInput() ?>

    <?= $form->field($model, 'invoice_number')->dropDownList(ArrayHelper::map(Invoice::find()->asArray()->all(), 'id', 'title'))->label('Invoice name'); ?>

    <?= $form->field($model, 'notes')->textarea(['maxlength' => true]) ?>

    <?= $form->field($model, 'is_sold')->checkbox() ?>
    
    <?= $form->field($model, 'sold_to')->dropDownList(ArrayHelper::map(Customers::find()->asArray()->all(), 'id', 'name'))?>
    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
