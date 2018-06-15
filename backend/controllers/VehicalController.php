<?php

namespace backend\controllers;

use Yii;
use common\models\Vehical;
use common\models\VehicalSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\Branddetails;
use common\models\AttributeValue;
use yii\web\UploadedFile;
use common\models\SubcatAttribute;
use common\models\VehicalImages;

/**
 * VehicalController implements the CRUD actions for Vehical model.
 */
class VehicalController extends BackendController
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Vehical models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new VehicalSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Vehical model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $category = \common\models\Category::find()->where(['status' => self::STATUS_ACTIVE])->all();
        return $this->render('view', [
            'model' => $this->findModel($id),
            'category'=>    $category,
        ]);
    }

    /**
     * Creates a new Vehical model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Vehical();
        $model1 = new \backend\models\Uploadfile();
        if ($model->load(Yii::$app->request->post())) {
            $model->status = self::STATUS_NOT_ACTIVE;
             if(isset($_FILES['Uploadfile']['name']['pfiles']) && $_FILES['Uploadfile']['name']['pfiles'] != null && $_FILES['Uploadfile']['name']['pfiles'] != ''){ 
                $proimage = UploadedFile::getInstances($model1, 'pfiles');
                if(!empty($proimage)){ //echo '<pre>'; print_r($_FILES); die;
                    foreach($proimage as $file){
                    $explode = explode('.', $file->name);
                    $filename = $explode[0];
                    $ext =  $explode[1];
                    $string = str_replace(' & ', '-', $filename);
                    $string = str_replace('  -  ', '-', $string);
                    $string = str_replace('+', '-', $string);
                    $string = str_replace('  - ', '-', $string);
                    $string = str_replace(' ', '-', $string);
                    $string = str_replace('---', '-', $string);
                    $string = str_replace('--', '-', $string);
                    $str= strtolower($string);
                    $name = $str ."-".time().'.'.$ext;
                    $rootPath = str_replace(DIRECTORY_SEPARATOR . 'backend', "", Yii::$app->basePath);
                    $filepath = $rootPath . '/backend/web/images/';
                    move_uploaded_file($file->tempName,$filepath.$name);
//                    $proimage->saveAs($filepath . $name);
                    $model->avatar_image = $name;
                    }
                }
            }
            if($model->save()){
                $attribute = new AttributeValue();
                $attribute->saveValue($model->id);
                return $this->redirect(['view', 'id' => $model->id]);
            }else{
                echo '<pre>'; print_r($model->errors); die;
            }
        }

        return $this->render('create', [
            'model' => $model,
            'image' => $model1
        ]);
    }

    /**
     * Updates an existing Vehical model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model1 = new \backend\models\Uploadfile();
        $oldimage = $model->avatar_image;
        if ($model->load(Yii::$app->request->post())) { 
            if(isset($_FILES['Uploadfile']['name']['pfiles']) && $_FILES['Uploadfile']['name']['pfiles'] != null && $_FILES['Uploadfile']['name']['pfiles'] != ''){ 
//                echo '<pre>'; print_r($_FILES); die;
                $proimage = UploadedFile::getInstances($model1, 'pfiles');
                if(!empty($proimage)){ 
                    foreach($proimage as $file){
                    $explode = explode('.', $file->name);
                    $filename = $explode[0];
                    $ext =  $explode[1];
                    $string = str_replace(' & ', '-', $filename);
                    $string = str_replace('  -  ', '-', $string);
                    $string = str_replace('+', '-', $string);
                    $string = str_replace('  - ', '-', $string);
                    $string = str_replace(' ', '-', $string);
                    $string = str_replace('---', '-', $string);
                    $string = str_replace('--', '-', $string);
                    $str= strtolower($string);
                    $name = $str ."-".time().'.'.$ext;
                    $rootPath = str_replace(DIRECTORY_SEPARATOR . 'backend', "", Yii::$app->basePath);
                    $filepath = $rootPath . '/backend/web/images/';
                    move_uploaded_file($file->tempName,$filepath.$name);
//                    $proimage->saveAs($filepath . $name);
                    $model->avatar_image = $name;
                    }
                }
            }
            if($model->save()){
                return $this->redirect(['view', 'id' => $model->id]);
            }else{
                echo '<pre>'; print_r($model->errors); die;
            }
        }

        return $this->render('update', [
            'model' => $model,'image' => $model1
        ]);
    }

    /**
     * Deletes an existing Vehical model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Vehical model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Vehical the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Vehical::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
    /*
     * This action call from JavaScript.  ( In Dropdown value)
     * Get Model list according to brand id
     * @param integer $id
     */
    public function actionGetmodel() {
        $option = "<option value=''>Select Model</option>";
        if (isset($_POST['id']) && !empty($_POST['id'])) {
            $id = $_POST['id'];
            $models = Branddetails::find()->where(['parent_id' => $id])->orderBy('name')->all();
            $data = $option;
            if (count($models) > 0) {
                foreach ($models as $_SubCategory) {
                    $data .= "<option value='" . $_SubCategory->id . "'>" . $_SubCategory->name . "</option>";
                }
            }
            echo $data;
        }
    }
    /*
     * This action call from JavaScript.  ( In Dropdown value)
     * Get Trim list according to Model  id
     * @param integer $id
     */
    public function actionGetTrim() {
        $option = "<option value=''>Select Trim</option>";
        if (isset($_POST['id']) && !empty($_POST['id'])) {
            $id = $_POST['id'];
            $trims = Branddetails::find()->where(['parent_id' => $id])->orderBy('name')->all();
            $data = $option;
            if (count($trims) > 0) {
                foreach ($trims as $_SubCategory) {
                    $data .= "<option value='" . $_SubCategory->id . "'>" . $_SubCategory->name . "</option>";
                }
            }
            echo $data;
        }
    }
    /*
     * This action call from JavaScript.  ( In Dropdown value)
     * Get Trim list according to Model  id
     * @param integer $id
     */
    public function actionOpenForm() {
        if (Yii::$app->request->isAjax) {
            $model = new AttributeValue();
            $image = new \backend\models\Uploadfile();
            $vehicalId = $_POST['vId'];
            $catId = $_POST['catId'];
            $subId = $_POST['subId'];
            $vehical = Vehical::find()->where(['id'=>$vehicalId])->one();
            $data = '';
            $cat = \common\models\Category::find()->where(['id' => $catId])->one();
            if($catId == 8){
                $data .= Yii::$app->controller->renderPartial('_image_form',['model'=>$model,'vehical'=>$vehical,'catId'=>$catId,'subcat_id'=>$subId,'image'=>$image]);
            }else{
                $data .= Yii::$app->controller->renderPartial('_attr_form',['model'=>$model,'vehical'=>$vehical,'catId'=>$catId,'subcat_id'=>$subId,'image'=>$image]);
            }
            \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            return [
                        'status' => 'success',
                        'data' => $data,
                   ];
        }
    }
    public function actionHideForm(){
        if (Yii::$app->request->isAjax) {
            $model = new AttributeValue();
            $vehicalId = $_POST['vId'];
            $catId = $_POST['catId'];
            $subId = $_POST['subId'];
            $catattr = SubcatAttribute::find()->where(['status' => self::STATUS_ACTIVE,'subcat_id' => $subId])->all();
            $data = '';
            foreach($catattr as $attr){
                $value = AttributeValue::find()->where(['v_id' => $vehicalId])->andWhere(['attribute_id' => $attr->id])->one();
                $data .= Yii::$app->controller->renderPartial('_attr_view',['attr' => $attr, 'value' => $value,'vid'=>$vehicalId]);
            }
            \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            return [
                        'status' => 'success',
                        'data' => $data,
                   ];
        }
    }

    public function actionSaveAttribute(){ 
        if (Yii::$app->request->isAjax && !empty($_POST['vId']) && !empty($_POST['sId'])) {
            $params = Yii::$app->request->post();
            foreach($params['AttributeValue'] as $i=>$_attr){
                $model = new AttributeValue();
                $savevalue = $model->updateValue($_attr);
                if(isset($_attr['image'])){ 
                    $proimage = UploadedFile::getInstancesByName('AttributeValue['.$i.'][image]');
                    if(!empty($proimage)){ 
                        foreach($proimage as $file){
                        $explode = explode('.', $file->name);
                        $filename = $explode[0];
                        $ext =  $explode[1];
                        $str= strtolower($filename);
                        $name = $str ."-".time().'.'.$ext;
                        $rootPath = str_replace(DIRECTORY_SEPARATOR . 'backend', "", Yii::$app->basePath);
                        $filepath = $rootPath . '/backend/web/documents/';
                        move_uploaded_file($file->tempName,$filepath.$name);
                        $documents = new VehicalImages();
                        $documents->setImageAttribute($name, $_attr, $ext);
                        }
                    }
                    
                }
            }
            $catattr = SubcatAttribute::find()->where(['status' => self::STATUS_ACTIVE,'subcat_id' => $_POST['sId']])->all();
            $data = '';
            foreach($catattr as $attr){
                $value = AttributeValue::find()->where(['v_id' => $_POST['vId']])->andWhere(['attribute_id' => $attr->id])->one();
                $data .= Yii::$app->controller->renderPartial('_attr_view',['attr' => $attr, 'value' => $value,'vid' => $_POST['vId']]);
            }
            
            \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            return [
                        'status' => 'success',
                        'data' => $data,
                   ];
        }
    }
    public function actionSaveImages(){ 
        if (Yii::$app->request->isAjax && !empty($_POST['vId']) && !empty($_POST['sId'])) {
            $params = Yii::$app->request->post();
            foreach($params['VehicalImages'] as $i=>$_attr){ 
                $model = new VehicalImages();
                $proimage = UploadedFile::getInstancesByName('VehicalImages['.$i.'][imagename]');
                if(!empty($proimage)){ 
                    foreach($proimage as $file){
                        if(!empty($file->name)){
                            $explode = explode('.', $file->name);
                            $filename = $explode[0];
                            $ext =  $explode[1];
                            $str= strtolower($filename);
                            $name = $str ."-".time().'.'.$ext;
                            $rootPath = str_replace(DIRECTORY_SEPARATOR . 'backend', "", Yii::$app->basePath);
                            $filepath = $rootPath . '/backend/web/images/';
                            move_uploaded_file($file->tempName,$filepath.$name);
                            $documents = new VehicalImages();
                            $documents->saveMultipleImages($name, $_attr, $ext);       
                        }                                         
                    }

                }
            }
            $catattr = SubcatAttribute::find()->where(['status' => self::STATUS_ACTIVE,'subcat_id' => $_POST['sId']])->all();
            $data = '';
            foreach($catattr as $attr){
                $value = AttributeValue::find()->where(['v_id' => $_POST['vId']])->andWhere(['attribute_id' => $attr->id])->one();
                $data .= Yii::$app->controller->renderPartial('_attr_view',['attr' => $attr, 'value' => $value,'vid' => $_POST['vId']]);
            }
            
            \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            return [
                        'status' => 'success',
                        'data' => $data,
                   ];
        }
    }
    public function actionDeleteImages(){ 
        if (Yii::$app->request->isAjax && !empty($_POST['id'])) {
            $params = Yii::$app->request->post();
            $image = VehicalImages::find()->where(['id' => $_POST['id']])->one();
            $image->status = 0;
            $image->save(false);
            \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            return [
                        'status' => 'success',
                   ];
        }
    }
    
    
}
