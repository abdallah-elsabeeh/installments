
<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\LearningObjective;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model backend\models\QuestionSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="questions-bank">



    <?php
    $form = ActiveForm::begin([
                'id' => '_search',
                'method' => 'get',
                'action' => ['customers/index'],
    ]);
    ?>
    <div class="row">
        <div class="col-md-4">
            <?=
                    $form->field($model, 'status')
                    ->dropDownList([1 => 'active', 0 => 'unactive'],['prompt' => \Yii::t('app', "Select Question Type")])
            ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'name') ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'id') ?>
        </div>

        <div class="col-md-4">
            <div class="form-group">
                <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
            </div>
        </div>


    </div>
    <?php ActiveForm::end(); ?>

</div>
