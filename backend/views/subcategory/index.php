<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\lib\SiteUtil;
use common\models\Category;

$cat = Category::find()->where(['id'=>$id])->one();

/* @var $this yii\web\View */
/* @var $searchModel common\models\SubcategorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Subcategories';
$this->params['breadcrumbs'][] = ['label' => 'Categories', 'url' => ['category/index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="subcategory-index">

    
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

   <p>
        <?= Html::a('Go Back', ['category/index'], ['class' => 'btn btn-success']) ?>  
        <?= Html::a('Create Sub Categories', ['create?id='.$id], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'name',
            [
                'label'     => 'Parent Category',
                'value'     => function($model){
                    return $model->parent->name;
                }
            ],

            ['class' => 'yii\grid\ActionColumn',
                'template' => ' {view}{update}{add-subcat} {view-subcat}',
                'contentOptions' => [
                    'class' => 'action-column'
                ],
                'buttons' => [
                    'view-subcat' => function ($data, $model) {
                       return Html::a('<span class="btn btn-info" title="Sub Category Attribute Listing" style="margin-left:15px;">Sub Category Attributes</span>', ['subcat-attribute/index',  'id' => $model->id]);
                    },
                    'add-subcat' => function ($data, $model) {
                       return Html::a('Add SubCategory Attribute', ['subcat-attribute/create','id'=>$model->id], ['class' => 'btn btn-info', 'id'=>'modalButton', 'style' => 'margin-left:15px; color:#fff;']);
//                       return '<button id="modalButton" class="btn btn-info" href="#" onClick="myFunction('.$model->id.')" style="margin-left:15px; color:#fff;">Add Sub Category</button>';
                    },

                ]
            ],
        ],
    ]); ?>
</div>
