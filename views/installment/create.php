<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Installment */

$this->title = Yii::t('app', 'Create Installment');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Installments'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="installment-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
