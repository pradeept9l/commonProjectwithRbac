<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Subcategory */

$this->title = 'Create Subcategory';
$this->params['breadcrumbs'][] = ['label' => 'Categories', 'url' => ['category/index']];
$this->params['breadcrumbs'][] = ['label' => 'Subcategories', 'url' => ['index?id='.$id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="subcategory-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'id'    =>  $id
    ]) ?>

</div>
