<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\Branddetails;

$cat = Branddetails::find()->where(['id'=>$id])->one();

$this->title = 'Create Model for '.$cat->name;
$this->params['breadcrumbs'][] = ['label' => 'Brand', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="product-categories-create">

    

    <div class="product-categories-form">

    <?php $form = ActiveForm::begin(); ?>
    
    <div class="form-group">
        <label class="control-label" for="">Brand Name</label>
        <input id="productcategories-categry_name" class="form-control" maxlength="100" disabled="true" value="<?= $cat->name ?>" type="text">
    </div>  
    <?= $form->field($model, 'name')->textInput(['maxlength' => true,'placeholder'=>'Enter Model name'])->label('Model name'); ?>
    <?= $form->field($model, 'status')->dropDownList($model->statusList) ?>
    <?= $form->field($model, 'parent_id')->hiddenInput(['value'=>$id])->label(false); ?>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

</div>
