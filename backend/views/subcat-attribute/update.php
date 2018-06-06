<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\SubcatAttribute */

$this->title = 'Update Subcat Attribute: ' . $model->name;

$this->params['breadcrumbs'][] = ['label' => 'Categories', 'url' => ['category/index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="subcat-attribute-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'id'    =>  $id
    ]) ?>

</div>
