<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\auth\AuthItem;

/* @var $this yii\web\View */
/* @var $model app\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field(new AuthItem(), 'name')
        ->dropDownList(
            ArrayHelper::map(AuthItem::find()->where(['type'=>'1'])->asArray()->all(), 'name', 'name')
        )->label('Role Name')
    ?>

    <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'password')->passwordInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'auth_key')->textInput(['maxlength' => true, 'value'=>random_int(10000,99999)]) ?>

    <?= $form->field($model, 'token')->textInput(['maxlength' => true, 'value'=>md5(random_bytes(8))]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
