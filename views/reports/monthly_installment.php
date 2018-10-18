<?php

use yii\grid\GridView;

$this->title = Yii::t('app', 'monthly installment');
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="invoice-index">
    <div id="ajaxCrudDatatable">

        <?=
        GridView::widget([
            'dataProvider' => $monthly_installment,
            'columns' => [
                'SUM',
                'YEAR',
                'MONTH',
            ],
        ]);
        ?>
    </div>
</div>
