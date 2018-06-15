<?php

use yii\helpers\Html;
use common\lib\SiteUtil;

/* @var $this yii\web\View */
/* @var $model common\models\Vehical */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="qstn-ans" >
 <?php if($attr->type == 1 || $attr->type == 3){ ?>
        <h2><?= $attr->name ?> <span>:</span><?= SiteUtil::getTypeName($attr->type, $value->answer); ?></h2>
        <label>comment <span>:</span> <?= (!empty($value->comments))?$value->comments:'NA'; ?></label><br>
        <label>Repair/ Replace Cost<span>:</span> <?= (!empty($value->repair_Cost))?$value->repair_Cost:'NA'; ?></label><br>
        <label>Score<span>:</span> <?= (!empty($value->score))?$value->score:'NA'; ?></label><br>
        <label>If Issue<span>:</span> <?= (!empty($value->ifissue))?$value->ifissue:'NA'; ?></label><br>
        <label>Score<span>:</span> <?= (!empty($value->score))?$value->score:'NA'; ?></label><br>
    <?php }elseif($attr->type == 2){ ?>
        <label><?= $attr->name ?> <span>:</span> <?= (!empty($value->comment))?$value->comment:'NA'; ?></label><br>
    <?php }else{ ?>
        <h2><?= $attr->name ?></h2>
        <?php if($attr->type == 2){
            echo "<label>".(!empty($value->comments))?$value->comments:'NA' ."</label>";
        }else{
            $image = \common\models\VehicalImages::find()->where(['status' => 1])->andWhere(['vehical_id' => $vid,'attr_id'=>$attr->id])->all();
            if($image){ ?>
        <div><?php 
                foreach($image as $_image){
            ?>
            <span class="multi-img"><img src="http://pumpum.loc/documents/<?= $_image->imagename ?>" /></span>
                <?php } ?>
        </div>
                <?php  } } } ?>
</div>
        