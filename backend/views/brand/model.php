<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\bootstrap\Modal ;
use yii\helpers\Url;
use common\models\Branddetails;
/* @var $this yii\web\View */
/* @var $searchModel common\models\ProductCategoriesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$cat = Branddetails::find()->where(['id'=>$id])->one();

$this->title = $cat->name.' Models List';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-categories-index">

   
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Go Back', ['brand/index'], ['class' => 'btn btn-success']) ?>  
            <?= Html::a('Add Model', ['brand/add-subcat?id='.$id], [    'class' => 'btn btn-success']) ?>
    </p>
    
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'id',
            'name',
            ['attribute'=>'parent_id',
               'value' => 'parent.name',
//                'filter' => Html::activeDropDownList($searchModel, 'parent_id', ['1'=>'Active','0'=>'Inactive'],['class'=>'form-control selectpicker','prompt' => 'Status']),
           ], 
            ['attribute'=>'status',
               'value' => function ($model) {
                   return $model->status == 1 ? 'Active' : 'Inactive';
               },
                'filter' => Html::activeDropDownList($searchModel, 'status', ['1'=>'Active','0'=>'Inactive'],['class'=>'form-control selectpicker','prompt' => 'Status']),
           ], 

            ['class' => 'yii\grid\ActionColumn',
                'template' => '{update-subcat}{add-subcat} {view-trim}',
                'contentOptions' => [
                    'class' => 'action-column'
                ],
                'buttons' => [
                    'update-subcat' => function ($data, $model) {
                        return Html::a('<span class="fa fa-edit" title="Update Category" style="margin-left:15px;"></span>', ['update-subcat', 'id' => $model->id]);
                    },
                    'view-trim' => function ($data, $model) {
                       return Html::a('<span class="btn btn-info" title="View Category" style="margin-left:15px;">View Sub Category</span>', ['view-trim', 'id' => $model->id]);
                    },
                    'add-subcat' => function ($data, $model) {
                       return Html::a('<span class="btn btn-info" title="Add Trim" style="margin-left:15px;">Add Trim</span>', ['add-subcat', 'id' => $model->id,'ch'=>1]);
                    },

                ]
            ],
        ],
     'pager' => [
        'firstPageLabel' => 'First',
        'lastPageLabel'  => 'Last'
    ],
    ]); ?>
</div>
