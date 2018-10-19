<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;

$this->title = Yii::t('app', 'monthly installment');
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="row">
    <div class="col-md-6">
        <h1>مجموع الاقساط غير المدفوعة: <?= $totalUnpaidInstallment; ?></h1>
    </div>
    <div class="col-md-6">
        <h1>مجموع الاقساط المتأخرة: <?= $totalDueInstallment; ?></h1>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <h1>مجموع الاقساط المدفوعة: <?= $totalPaidInstallment; ?></h1>
    </div>
    <div class="col-md-6">
        <h1>مجموع الاقساط الكلي: <?= $totalInstallment; ?></h1>
    </div>
</div>
<div class="row">
    <div class="col-md-4">
        <?= Html::a(Yii::t('app', 'monthly installment beer user'), ['reports/monthly-installment-beer-user'], ['class' => 'btn btn-success']) ?>

    </div>
    <div class="col-md-4">
        <?= Html::a(Yii::t('app', 'monthly installment'), ['reports/monthly-installment'], ['class' => 'btn btn-success']) ?>

    </div>
      <div class="col-md-4">
        <?= Html::a(Yii::t('app', 'due installment'), ['reports/due-installment'], ['class' => 'btn btn-success']) ?>

    </div>
</div>
