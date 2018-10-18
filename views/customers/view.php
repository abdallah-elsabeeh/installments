<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Customers */
?>
<div class="customers-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'status',
        ],
    ]) ?>

</div>
