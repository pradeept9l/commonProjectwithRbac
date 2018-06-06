<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\BranddetailsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Branddetails';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="branddetails-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Branddetails', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'name',
            ['attribute'=>'status',
               'value' => function ($model) {
                   return $model->status == 1 ? 'Active' : 'Inactive';
               },
                'filter' => Html::activeDropDownList($searchModel, 'status', ['1'=>'Active','0'=>'Inactive'],['class'=>'form-control selectpicker','prompt' => 'Status']),
           ], 

            ['class' => 'yii\grid\ActionColumn',
                'template' => ' {view}{update}{add-subcat} {view-model}',
                'contentOptions' => [
                    'class' => 'action-column'
                ],
                'buttons' => [
                    'view-model' => function ($data, $model) {
                       return Html::a('<span class="btn btn-info" title="Model Listing" style="margin-left:15px;">View Model</span>', ['view-model',  'id' => $model->id]);
                    },
                    'add-subcat' => function ($data, $model) {
                       return Html::a('Add Model', ['add-subcat','id'=>$model->id], ['class' => 'btn btn-info', 'id'=>'modalButton', 'style' => 'margin-left:15px; color:#fff;']);
//                       return '<button id="modalButton" class="btn btn-info" href="#" onClick="myFunction('.$model->id.')" style="margin-left:15px; color:#fff;">Add Sub Category</button>';
                    },

                ]
            ],
        ],
    ]); ?>
</div>
