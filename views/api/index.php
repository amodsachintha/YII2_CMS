<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\searches\ApiSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'API Keys';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="api-index">

    <div class="row">
        <div class="col-sm-10">
            <h1><?= Html::encode($this->title) ?></h1>
        </div>
        <div class="col-sm-2" >
            <p style="margin-top: 25px"">
                <?= Html::a('Create API key', ['create'], ['class' => 'btn btn-success btn-block']) ?>
            </p>
        </div>
    </div>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
//        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'id',
            'key',
            'hits',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
