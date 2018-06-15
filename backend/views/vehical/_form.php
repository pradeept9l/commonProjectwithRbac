<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\Category;
use common\models\Subcategory;
use common\models\SubcatAttribute;
use common\models\Vehical;
use common\models\Branddetails;
use yii\helpers\ArrayHelper;
use common\models\Color;
use common\lib\SiteUtil;
use kartik\file\FileInput;


/* @var $this yii\web\View */
/* @var $model common\models\Vehical */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="vehical-form">
    
    <?php $form = ActiveForm::begin(); ?>
    <section class="vehicledetails">
    <div class="row">
        <div class="col-md-4">
            <?php
                $dataList = ArrayHelper::map(Branddetails::find()
                        ->where(['status' => 1, 'parent_id' => 0])
                        ->asArray()->orderBy(['id' => SORT_ASC])->all(), 'id', 'name');
                echo $form->field($model, 'brand_id')
                    ->dropDownList(
                            $dataList, ['class' => 'selectpicker form-control', 'prompt' => 'Select Brand', 'onchange' => '$.post("' . Yii::$app->urlManager->createUrl('vehical/getmodel') . '",{id:$(this).val(),_csrf: yii.getCsrfToken()},function( data ) 
                           {  $( "select#model_id" ).html( data );   $(".selectpicker").selectpicker("refresh");}); ']
                    )->label('Brand');
            ?>
        </div>
        <div class="col-md-4">
            <?php
            $modellist = ArrayHelper::map(Branddetails::find()->where(['parent_id' => $model->brand_id])->orderBy('id')->asArray()->all(), 'id', 'name');
            echo $form->field($model, 'model_id')->dropDownList($modellist, ['prompt' => 'Select Model',
                'class' => 'form-control selectpicker',
                'id' => 'model_id',
                'onchange' => '$.post("' . Yii::$app->urlManager->createUrl('vehical/get-trim') . '",{id:$(this).val(),_csrf: yii.getCsrfToken()},function( data ) 
                           {  $( "select#trim_id" ).html( data );   $(".selectpicker").selectpicker("refresh");}); ',
            ])->label('Model');
            ?>
        </div>
        <div class="col-md-4">
             <?php
            $trimlist = ArrayHelper::map(Branddetails::find()->where(['parent_id' => $model->model_id])->orderBy('id')->asArray()->all(), 'id', 'name');
            echo $form->field($model, 'trim_id')->dropDownList($trimlist, ['prompt' => 'Select Trim',
                'class' => 'form-control selectpicker',
                'id' => 'trim_id',
            ])->label('Trim');
            ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <?php  
                $dataList = ArrayHelper::map(Color::find()
                        ->where(['status' => 1])
                        ->asArray()->orderBy(['id' => SORT_ASC])->all(), 'id', 'name');
                echo $form->field($model, 'color_id')
                    ->dropDownList( $dataList ,['prompt' => 'Select Color',
                'class' => 'form-control selectpicker',
                'id' => 'color',
            ])->label('Color');
            ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'fuel')->dropDownList(SiteUtil::getFuelType()) ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'year')->dropDownList(SiteUtil::getYearList()) ?>
        </div>
        <div class="col-md-12">
            <?=  $form->field($image, 'pfiles')->widget(FileInput::classname(), [
    'options' => ['accept' => 'image/*','multiple' => false],])->label('Vehical Image');             ?> 
            
        </div>
         <div class="form-group col-md-12">
            <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
        </div>
    </div>
    </section>
     <?php ActiveForm::end(); ?>
    
        

   


</div>
