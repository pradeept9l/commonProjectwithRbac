<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Vehical */

$this->title = 'Create Vehical';
$this->params['breadcrumbs'][] = ['label' => 'Vehicals', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="vehical-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,'image' => $image
    ]) ?>

</div>
