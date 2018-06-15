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

            $value = new \common\models\VehicalImages();
?>



<div class="col-md-12">
    <?php $form = ActiveForm::begin(['enableClientValidation' => false,
        'enableAjaxValidation' => true,
        'validateOnChange' => true,
        'validateOnBlur' => false,'options' => [
        'enctype' => 'multipart/form-data',
        'id'=>'saveimages-'.$subcat_id]]); ?>    
        <?php foreach($catattribute as $key => $attr){ 
            $categoryid = Subcategory::find()->where(['id' => $subcat_id])->one();
            $image = \common\models\VehicalImages::find()->where(['status'=>1, 'vehical_id' => $vehical->id])->andWhere(['attr_id'=>$attr->id])->all();            
            ?>
            <div class="col-md-12 valuebox">
                    
                    <div>
                    <?php if($image){
                        foreach($image as $_image){ ?>
                        <span class="multi-img" id="img-<?= $_image->id; ?>"> 
                            <a href="javascript:void(0);" class="deletebtn" onclick="DeleteImage(<?= $_image->id; ?>)">*</a>
                            <img src="http://pumpum.loc/documents/<?= $_image->imagename ?>" />
                        </span>
                    <?php  }
                    }
                    ?>
                    </div>
                    <?= $form->field($value, '['.$key.']vehical_id')->hiddenInput(['value' => $vehical->id])->label(FALSE); ?>
                    <?= $form->field($value, '['.$key.']cat_id')->hiddenInput(['value' => $categoryid->cat_id])->label(FALSE); ?>
                    <?= $form->field($value, '['.$key.']attr_id')->hiddenInput(['value' => $attr->id])->label(FALSE); ?>
                    <?php 
                         echo $form->field($value, '['.$key.']imagename')->widget(FileInput::classname(), [
    'options' => ['accept' => 'image/*','multiple' => TRUE],])->label($attr->name);                        
                    ?>                    
                </div>
        <?php } ?>
        <div class="form-group col-md-12">
            <a class="btn btn-success" onclick="submitImageform(<?= $subcat_id; ?>,<?= $vehical->id; ?>,<?= $categoryid->cat_id; ?>)">Save</a>
        </div>
    <?php ActiveForm::end(); ?>
</div>

        