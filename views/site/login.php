<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */

/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\widgets\Breadcrumbs;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>

<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <link rel="stylesheet" href="/css/bootstrap4.min.css">
    <script src="/js/bootstrap4.min.js"></script>
</head>
<body style="background-color: rgba(149, 187, 228, 0.5); width: 100%">

<div class="container">
    <nav class="navbar navbar-expand-lg navbar-dark justify-content-between">
        <a class="navbar-brand text-dark" href="/"><img src="/img/logo2.png" width="35" alt="home"><strong> CMS</strong></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav">
            </ul>
        </div>
    </nav>
    <div class="row" style="margin-top: 100px">
        <div class="col-md-6 offset-3">
            <div class="card text-center shadow bg-light">
                <div class="card-header">
                    <a href="/"><img src="/img/logo2.png" width="100"></a>
                </div>
                <div class="card-body" style="font-size: small">
                    <div class="text-center"><h4><?= Html::encode($this->title) ?></h4></div>
                    <p class="text-secondary">Please fill out the following fields to login:</p>

                    <?php $form = ActiveForm::begin([
                        'id' => 'login-form',
                        'fieldConfig' => [
                            'template' => "<div class='ml-3 text-secondary' style='text-align: left'><strong>{label}</strong></div>\n<div class=\"col-sm-12\">{input}</div>\n<div class=\"text-danger\">{error}</div>",
                            'labelOptions' => ['class' => 'control-label'],
                        ],
                    ]); ?>

                    <?= $form->field($model, 'email')->textInput(['autofocus' => true, 'class' => 'form-control form-control-sm', 'type'=>'email']) ?>

                    <?= $form->field($model, 'password')->passwordInput(['class' => 'form-control form-control-sm']) ?>

                    <?= $form->field($model, 'rememberMe')->checkbox([
                        'template' => "<div class=\"col-lg-offset-1 col-sm-12\">{input} {label}</div>\n<div class=\"text-danger\">{error}</div>",
                    ]) ?>

                    <div class="form-group">
                        <div class="offset-2 col-lg-8">
                            <?= Html::submitButton('Login', ['class' => 'btn btn-outline-primary btn-block', 'name' => 'login-button']) ?>
                        </div>
                    </div>

                    <?php ActiveForm::end(); ?>
                </div>
                <div class="card-footer" style="font-size: x-small">
                        <?php echo $_SERVER['SERVER_NAME'].' - '.$_SERVER['SERVER_PROTOCOL'].' - '.$_SERVER['SERVER_SOFTWARE']; ?>
                </div>
            </div>

        </div>
    </div>
</div>


</body>
</html>


