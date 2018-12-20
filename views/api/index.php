<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\searches\ApiSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Apis';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="api-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Api', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'key',
            'hits',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
