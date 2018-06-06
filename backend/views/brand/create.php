<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Branddetails */

$this->title = 'Create Branddetails';
$this->params['breadcrumbs'][] = ['label' => 'Branddetails', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="branddetails-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model
    ]) ?>

</div>
