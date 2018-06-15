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
use common\models\AttributeValue;



/* @var $this yii\web\View */
/* @var $model common\models\Vehical */
/* @var $form yii\widgets\ActiveForm */

//$category = Category::find()->where(['status'=> Category::STATUS_ACTIVE])->andWhere(['id'=>$catId])->one();
$catattribute = SubcatAttribute::find()->where(['subcat_id' => $subcat_id])->all();

?>



<div class="col-md-12">
    <?php $form = ActiveForm::begin(['enableClientValidation' => false,
        'enableAjaxValidation' => true,
        'validateOnChange' => true,
        'validateOnBlur' => false,'options' => ['action' => 'vehical/save-attribute',
        'enctype' => 'multipart/form-data',
        'id'=>'saveattributes-'.$subcat_id]]); ?>    
        <?php foreach($catattribute as $attr){
            if($catId == 8){ ?>
                
            <?php }else{
            $value = AttributeValue::find()->where(['v_id' => $vehical->id,'attribute_id' => $attr->id])->one();
            if($attr->type == 1 || $attr->type == 3){                
            ?>
            <div class="col-md-12 valuebox">
                <div class="col-md-3">
                    <?= $form->field($value, '['.$value->id.']v_id')->hiddenInput(['value' => $vehical->id])->label(''); ?>
                    <?= $form->field($value, '['.$value->id.']cat_id')->hiddenInput(['value' => $value->cat_id])->label(''); ?>
                    <?= $form->field($value, '['.$value->id.']subcat_id')->hiddenInput(['value' => $value->subcat_id])->label(''); ?>
                    <?= $form->field($value, '['.$value->id.']attribute_id')->hiddenInput(['value' => $attr->id])->label(FALSE); ?>
                    <?= $form->field($value, '['.$value->id.']id')->hiddenInput(['value' => $value->id])->label(FALSE); ?>
                    <?= $form->field($value, '['.$value->id.']answer')->dropDownList(SiteUtil::getFileTypeList($attr->type))->label($attr->name); ?>
                </div>
                <div class="col-md-9">
                    <div class="col-md-12"><?= $form->field($value, '['.$value->id.']comments')->textarea(['rows' => '2'])->label('Comment'); ?></div>
                    <div class="col-md-12"><?= $form->field($value, '['.$value->id.']ifissue')->textarea(['rows' => '2'])->label('If issue'); ?></div>
                    <div class="col-md-6"><?= $form->field($value, '['.$value->id.']repair_Cost')->textInput()->label('Repair Cost'); ?></div>
                    <div class="col-md-6"><?= $form->field($value, '['.$value->id.']score')->textInput([''])->label('Score'); ?></div>
                </div>
                <?php }else{ ?>
                <div class="col-md-12 valuebox">
                    <?= $form->field($value, '['.$value->id.']v_id')->hiddenInput(['value' => $vehical->id])->label(FALSE); ?>
                    <?= $form->field($value, '['.$value->id.']cat_id')->hiddenInput(['value' => $value->cat_id])->label(FALSE); ?>
                    <?= $form->field($value, '['.$value->id.']subcat_id')->hiddenInput(['value' => $value->subcat_id])->label(FALSE); ?>
                    <?= $form->field($value, '['.$value->id.']attribute_id')->hiddenInput(['value' => $attr->id])->label(FALSE); ?>
                    <?= $form->field($value, '['.$value->id.']id')->hiddenInput(['value' => $value->id])->label(FALSE); ?>
                    <?= $form->field($value, '['.$value->id.']answer')->hiddenInput(['value' => 1])->label(FALSE); ?>
                    <?php 
                        echo $form->field($value, '['.$value->id.']ifissue')->hiddenInput(['value' => ''])->label(FALSE);
                        echo $form->field($value, '['.$value->id.']repair_Cost')->hiddenInput(['value' => 0])->label(FALSE);
                        echo $form->field($value, '['.$value->id.']score')->hiddenInput(['value' => ''])->label(FALSE);
                        if($attr->type == 2){ 
                            echo $form->field($value, '['.$value->id.']comments')->textInput()->label($attr->name);
                        }else{
                           echo $form->field($value, '['.$value->id.']image')->widget(FileInput::classname(), [
    'options' => ['accept' => 'image/*','multiple' => false],])->label($attr->name);   
                           echo $form->field($value, '['.$value->id.']comments')->textarea(['rows' => '2'])->label('Comments');
                        }
                    ?>
                    
                </div>
                <?php } ?>
                
               
            </div>
            <?php } } ?>
        <div class="form-group col-md-12">
            <a class="btn btn-success" onclick="submitAttributeform(<?= $subcat_id; ?>,<?= $vehical->id; ?>,<?= $catId; ?>)">Save</a>
        </div>
    <?php ActiveForm::end(); ?>
</div>

        