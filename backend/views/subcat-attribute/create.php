<?php

use yii\helpers\Html;
use common\models\Subcategory;

$cat = Subcategory::find()->where(['id'=>$id])->one();
/* @var $this yii\web\View */
/* @var $model common\models\SubcatAttribute */

$this->title = 'Create Subcat Attribute';

$this->params['breadcrumbs'][] = ['label' => 'Categories ', 'url' => ['category/index']];
$this->params['breadcrumbs'][] = ['label' => 'Subcategories : '.$cat->name, 'url' => ['subcategory/index?id='.$cat->cat_id]];
$this->params['breadcrumbs'][] = ['label' => 'Subcat Attributes', 'url' => ['index?id='.$id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="subcat-attribute-create">

    

    <?= $this->render('_form', [
        'model' => $model,
        'id'    =>  $id
    ]) ?>

</div>
