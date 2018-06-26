<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\Category;
use common\lib\SiteUtil;

$cat = Category::find()->where(['id'=>$id])->one();

$this->title = 'Create Sub Category';

/* @var $this yii\web\View */
/* @var $model common\models\Subcategory */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="subcategory-form">
 <p>
        <?= Html::a('Go Back', ['subcategory/index?id='.$id], ['class' => 'btn btn-success']) ?>
    </p>
    <?php $form = ActiveForm::begin(); ?>
    <div class="form-group">
        <label class="control-label" for="">Category Name</label>
        <input id="" class="form-control" maxlength="100" disabled="true" value="<?= $cat->name ?>" type="text">
    </div>  
    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')->dropDownList(SiteUtil::getStatusList()) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
