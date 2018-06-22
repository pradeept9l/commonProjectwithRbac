<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\file\FileInput;
/* @var $this yii\web\View */
/* @var $model common\models\Branddetails */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="branddetails-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
    <div class="col-md-12">
    <?= $form->field($model, 'img_url')->widget(FileInput::classname(), [
    'options' => ['accept' => 'image/*','multiple' => false],])->label('Image'); ?> 
    </div>
    <?= $form->field($model, 'status')->dropDownList($model->statusList) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
