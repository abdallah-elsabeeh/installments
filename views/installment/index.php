<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\InstallmentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Installments');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="installment-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        
        <?= Html::a(Yii::t('app', 'Create Installment'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <h1>مجموع الاقساط الكلي:<?=$installmentSummary->userTotalInstallment;?></h1>
    <h1>مجموع الاقساط المدفوعة:<?=($installmentSummary->userPaidInstallment)?$installmentSummary->userPaidInstallment:0;?></h1>
    <h1>مجموع الاقساط الغير مدفوعة:<?=($installmentSummary->userUnPaidInstallment)?$installmentSummary->userUnPaidInstallment:0;?></h1>
    <h1>مجموع الاقساط المتأخرة:<?=($installmentSummary->userOverdueInstallment)?$installmentSummary->userOverdueInstallment:0;?></h1>
    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'rowOptions' => function($model) {
            if ($model->is_made_payment==1) {
                return ['class' => 'success'];
            }
            if($model->date < date('Y-m-d') && $model->is_made_payment==0){
                return ['class' => 'danger'];
            }
        },
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    [
                        'attribute' => 'item',
                        'label' => 'Item Name',
                        'value' => 'item.name'
                    ],
                    [
                        'attribute' => 'customer_id',
                        'label' => 'customer name',
                        'value' => 'customer.name'
                    ],
                    'date',
//                    'cheque_number',
                    // 'notes',
//                    'is_made_payment',
                    'total',
                    ['class' => 'yii\grid\ActionColumn'],
                ],
            ]);
            ?>
</div>
