<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'About';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>The SCMA CMS Application stores and serves text and media through API endpoints such that a multitude of decoupled apps rely on it.
    This is the content management application for the API.</p>

</div>
