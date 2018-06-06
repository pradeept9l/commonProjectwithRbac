<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\Subcategory;
use common\lib\SiteUtil;

$cat = Subcategory::find()->where(['id'=>$id])->one();

/* @var $this yii\web\View */
/* @var $model common\models\SubcatAttribute */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="subcat-attribute-form">
    <p>
        <?= Html::a('Go Back', ['subcat-attribute/index?id='.$id], ['class' => 'btn btn-success']) ?>
    </p>
    <?php $form = ActiveForm::begin(); ?>
    <div class="form-group">
        <label class="control-label" for="">Sub Category Name</label>
        <input id="" class="form-control" maxlength="100" disabled="true" value="<?= $cat->name ?>" type="text">
    </div>  
    
    <?= $form->field($model, 'name')->textInput(['maxlength' => true])->label('Sub Category Attribute') ?>
    <?= $form->field($model, 'type')->radioList(['1' => 'Yes / No', '2' => 'Text Field', '3' => 'Good / Average / Poor', '4' => 'File',])  ?>
<!--$form->field($model, 'vegan')->checkBox(['label' => 'Vegan', 'uncheck' => 0, 'checked' => 1]);-->
    <?= $form->field($model, 'subcat_id')->hiddenInput(['value'=> $id])->label(FALSE) ?>

    <?= $form->field($model, 'status')->dropDownList(SiteUtil::getStatusList()) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
