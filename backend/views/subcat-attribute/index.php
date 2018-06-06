<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\models\Subcategory;
$cat = Subcategory::find()->where(['id' =>$id])->one();
//echo '<pre>'; print_r($cat); die;

/* @var $this yii\web\View */
/* @var $searchModel common\models\SubcatAttributeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Subcat Attributes';
$this->params['breadcrumbs'][] = ['label' => 'Categories : '.$cat->parent->name, 'url' => ['category/index']];
$this->params['breadcrumbs'][] = ['label' => 'Subcategories : '.$cat->name, 'url' => ['subcategory/index?id='.$cat->cat_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="subcat-attribute-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Go Back', ['subcategory/index?id='.$cat->cat_id], ['class' => 'btn btn-success']) ?>  
        <?= Html::a('Create Sub Cate Attribute', ['create?id='.$id], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            'subcat_id',
            'created_at',
            'updated_at',
            //'status',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
