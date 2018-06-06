<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\CategorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Categories';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="category-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Category', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'name',
            [
                'attribute' => 'weightage',
                'value' => function($model){
                    return $model->weightage.'%';
                }
            ],
            //'status',

            ['class' => 'yii\grid\ActionColumn',
                'template' => ' {view}{update}{add-subcat} {view-subcat}',
                'contentOptions' => [
                    'class' => 'action-column'
                ],
                'buttons' => [
                    'view-subcat' => function ($data, $model) {
                       return Html::a('<span class="btn btn-info" title="Sub Category Listing" style="margin-left:15px;">Sub Category Listing</span>', ['subcategory/index',  'id' => $model->id]);
                    },
                    'add-subcat' => function ($data, $model) {
                       return Html::a('Add SubCategory', ['subcategory/create','id'=>$model->id], ['class' => 'btn btn-info', 'id'=>'modalButton', 'style' => 'margin-left:15px; color:#fff;']);
//                       return '<button id="modalButton" class="btn btn-info" href="#" onClick="myFunction('.$model->id.')" style="margin-left:15px; color:#fff;">Add Sub Category</button>';
                    },

                ]
            ],
        ],
    ]); ?>
</div>
