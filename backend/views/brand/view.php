<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Branddetails */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Branddetails', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="branddetails-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
          //  'id',
            'name',
            'parent_id',
                [
                'attribute' => 'created_at',
                'format' => ['date', 'php:d-M-Y'],
              
            ],
              [
                'attribute' => 'updated_at',
                'format' => ['date', 'php:d-M-Y'],
              
            ],
               [
            'attribute' =>'status',    
            'label' => 'Status',
            'value' => function($model) {
                    return $model->status==1?'Active':'Inactive';
                  },
           ],
                           [
               'attribute'=>'img_url',
               'label'=>'Image',
               'format'=>'raw',
                'value' => function ($data) { 
                        $url = \Yii::$app->params['backendUrl'].'images/'.$data->img_url;
                       return Html::img($url, ['alt'=>'myImage','width'=>'100','height'=>'70']);
                }
                ],
        ],
    ]) ?>

</div>
