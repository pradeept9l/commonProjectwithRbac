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

    $this->title = $cat->name.'  Child Categories';
    $this->params['breadcrumbs'][] = $cat->name .' > Trim';
?>
<div class="product-categories-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Go Back', ['brand/view-model?id='.$cat->parent_id], ['class' => 'btn btn-success']) ?>  
        <?= Html::a('Create Child Categories', ['brand/add-subcat?id='.$id.'&ch=1'], ['class' => 'btn btn-success']) ?>
    </p>
    
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
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
                'template' => '{delete}{update-subcat}',
                'contentOptions' => [
                    'class' => 'action-column'
                ],
                'buttons' => [
                    'update-subcat' => function ($data, $model) {
                        return Html::a('<span class="fa fa-edit" title="Update Category" style="margin-left:15px;"></span>', ['update-subcat', 'id' => $model->id,'ch'=>1],['target'=> '_blank']);
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
