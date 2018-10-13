<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Items;
use yii\helpers\ArrayHelper;
use app\models\Customers;
use kartik\date\DatePicker;
/* @var $this yii\web\View */
/* @var $model app\models\Installment */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="installment-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'total')->textInput() ?>
    
    <?= $form->field($model, 'item_id')->dropDownList(ArrayHelper::map(Items::find()->asArray()->all(), 'id', 'name'))->label('Item name'); ?>

    <?= $form->field($model, 'customer_id')->dropDownList(ArrayHelper::map(Customers::find()->asArray()->all(), 'id', 'name'))?>

    <?= $form->field($model, 'date')->widget(DatePicker::classname(), [
    'options' => ['placeholder' => 'Enter birth date ...'],
    'pluginOptions' => [
        'autoclose'=>true,
        'format' => 'yyyy-mm-dd'
    ]
]);?>

    <?= $form->field($model, 'cheque_number')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'notes')->textarea() ?>

    <?= $form->field($model, 'is_made_payment')->checkbox() ?>

    <?= $form->field($model, 'total')->textInput() ?>

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
