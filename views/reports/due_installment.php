<?php

use yii\grid\GridView;

$this->title = Yii::t('app', 'monthly installment');
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="invoice-index">
    <div id="ajaxCrudDatatable">

        <?=
        GridView::widget([
            'dataProvider' => $due_installment,
            'columns' => [
                'total_sum',
                'total_installment',
                'date',
                'name',
                'notes'
            ],
        ]);
        ?>
    </div>
</div>
