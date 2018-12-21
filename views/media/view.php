<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Media */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Media', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="media-view">

    <h1><?= Html::encode($model->description) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'document.title',
            [
                'label' => 'URL',
                'format'=>'raw',
                'value' => function ($model) {
                    return Html::a('Open',$model->url,['class'=>'btn btn-default btn-sm', 'target'=>'_blank']);
                }
            ],
            [
                    'label'=>'preview',
                'format'=>'raw',
                'value' => function($model){
                    return "<a href='#' class='thumbnail'>
                                <img src='$model->url' alt='preview' width='200'>
                             </a>";
                }
            ],
            'description',
            'created_at:datetime',
            'updated_at:datetime',
        ],
    ]) ?>

</div>
