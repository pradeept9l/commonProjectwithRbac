<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\models\Category;
use common\models\Subcategory;
use common\models\SubcatAttribute;
use common\lib\SiteUtil;

/* @var $this yii\web\View */
/* @var $model common\models\Vehical */

$this->title = 'Vehical Details';
$this->params['breadcrumbs'][] = ['label' => 'Vehicals', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="vehical-view">

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?php // echo Html::a('Delete', ['delete', 'id' => $model->id], [
//            'class' => 'btn btn-danger',
//            'data' => [
//                'confirm' => 'Are you sure you want to delete this item?',
//                'method' => 'post',
//            ],
//        ]) ?>
    </p>
    <?php if($model){
        
        
        ?>
    <section class="content">

      <div class="row">
        <div class="col-md-3">

          <!-- Profile Image -->
          <div class="box box-primary">
            <div class="box-body box-profile">
                <img class="profile-user-img img-responsive" src="<?= Yii::$app->params['backendUrl'].'images/'.$model->avatar_image; ?>" alt="User profile picture">

              <h3 class="profile-username text-center"><?= $model->brand->name; ?></h3>

              <p class="text-muted text-center"><?= $model->model->name; ?></p>

              <ul class="list-group list-group-unbordered">
                <li class="list-group-item">
                  <b>Making Year</b> <a class="pull-right"><?= $model->year; ?></a>
                </li>
                <li class="list-group-item">
                  <b>Color</b> <a class="pull-right"><?= $model->color->name; ?></a>
                </li>
                <li class="list-group-item">
                  <b>Fuel Type</b> <a class="pull-right"><?= ($model->fuel == 1)?'Petrol':'Diesel'; ?></a>
                </li>
              </ul>
              <div class="btn-group" style="width:100%;" >
                  <button style="width:80%;" type="button" class="btn btn-success"><?= ($model->status == 1)?'Active':'Inactive'; ?></button>
                  <button style="width:20%;" type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                    <span class="caret"></span>
                    <span class="sr-only">Toggle Dropdown</span>
                  </button>
                  <ul class="dropdown-menu" role="menu">
                    <li><a href="<?= Yii::$app->params['backendUrl']?>vehical/vehical-active?id=<?= $model->id?>">Active</a></li>
                    <li class="divider"></li>
                    <li><a href="<?= Yii::$app->params['backendUrl']?>vehical/vehical-active?id=<?= $model->id?>">Inactive</a></li>
                  </ul>
                </div>
              <!--<a href="javascript:void(0);" class="btn btn-primary btn-block"><b></b></a>-->
            </div>
            <!-- /.box-body -->
          </div>
        </div>
        <!-- /.col -->
        <div class="col-md-9">
            
            <?php foreach($category as $key => $cat){ 
                $subcat = Subcategory::find()->where(['status' => 1,'cat_id' => $cat->id])->all();
                ?>
                <div class="box box-primary <?= ($key == 0)?'':'collapsed-box'; ?>">
                    <div class="box-header with-border">
                        <h3 class="box-title"><?= $cat->name; ?></h3>
                        <!--<span>Rating: <b>0%</b><input class="rangeslider-<?= $cat->id; ?>" data-slider-id='ex1Slider' type="text" data-slider-min="0" data-slider-max="25" data-slider-step="1" data-slider-value="1"/><b>25%</b></span>-->
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool"  data-widget="collapse">
                                <i class="<?= ($key == 0)?'fa fa-minus':'fa fa-plus'; ?>"></i>
                            </button>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <?php if($key == 0){ echo '<div class="box-body">'; }else{ ?>
                    <div class="box-body" style="display: none;" >
                    <?php } ?>
                        <?php foreach($subcat as $_subcat){ 
                            $catattr = SubcatAttribute::find()->where(['status' => 1,'subcat_id' => $_subcat->id])->all();
                            ?>                                                                                                                                                                      
                        <div class="col-md-12 subcat">
                            <div class="category-new">
                                <div class="box-header with-border">
                                    <h3 class="box-title"><?= $_subcat->name; ?></h3>

                                    <div class="box-tools pull-right">
                                        <span><a class="edit" onclick="openForm('<?= $model->id ?>', '<?= $cat->id ?>', '<?= $_subcat->id ?>')" id="editbtn-<?= $_subcat->id ?>" href="javascript:void(0)">EDIT</a></span>
                                    </div>

                                </div>
                                <div id="box-<?= $_subcat->id; ?>">
                                <?php foreach($catattr as $attr){ 
                                    $value = common\models\AttributeValue::find()->where(['v_id' => $model->id])->andWhere(['attribute_id' => $attr->id])->one();
                                    echo Yii::$app->controller->renderPartial('_attr_view',['attr' => $attr, 'value' => $value,'vid' => $model->id]);
                                    
                                } ?>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer text-center" style="">
                        <a href="javascript:void(0)" class="uppercase">View All Products</a>
                    </div>
                    <!-- /.box-footer -->
                </div>
            <?php } ?>
                <!-- /.nav-tabs-custom -->
            </div>
        <!-- /.col -->
      </div>
    </section>
    <?php } ?>
</div>
