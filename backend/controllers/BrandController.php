<?php

namespace backend\controllers;

use Yii;
use common\models\Branddetails;
use common\models\BranddetailsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\controllers\BackendController;
use common\lib\SiteUtil;

/**
 * BrandController implements the CRUD actions for Branddetails model.
 */
class BrandController extends BackendController
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
     * Lists all Branddetails models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new BranddetailsSearch();
        $searchModel->parent_id = self::IS_PARENT;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Branddetails model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Branddetails model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Branddetails();

        if ($model->load(Yii::$app->request->post())) {
            $model->parent_id = self::IS_PARENT;
            $model->url_safe = SiteUtil::getUrlFormate($_POST['Branddetails']['name']);
            $authimage = \yii\web\UploadedFile::getInstance($model, 'img_url');
            if (!empty($authimage)) {
                $rootPath = str_replace(DIRECTORY_SEPARATOR . 'backend', "", Yii::$app->basePath);
                $filepath = $rootPath . '/backend/web/images/';
                $exp_var = explode('.', $authimage->name);
                $ext = end($exp_var);
                $randomstring = time() ."-". $model->url_safe."." . $ext;
                $model->img_url = $randomstring;
                $authimage->saveAs($filepath . $randomstring);
            }
            if ($model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                echo '<pre>';print_r($model->errors);die;
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Branddetails model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            $model->parent_id = self::IS_PARENT;
            $model->url_safe = SiteUtil::getUrlFormate($_POST['Branddetails']['name']);
            if($model->save()){
            return $this->redirect(['view', 'id' => $model->id]);
            }else{
                echo '<pre>'; print_r($model->errors); die;
            }
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Branddetails model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
            $model->status = 2;
            $model->update();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Branddetails model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Branddetails the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Branddetails::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
    public function actionAddSubcat($id){ 
        $model = new Branddetails(); 
        if ($model->load(Yii::$app->request->post())) { 
            $model->url_safe = SiteUtil::getUrlFormate($_POST['Branddetails']['name']);
            if($model->save()){
                if(isset($_GET['ch']) && $_GET['ch']){
                    Yii::$app->session->setFlash('success','Sub Category Child added successfully.');
                    return $this->redirect(\Yii::$app->urlManager->createUrl(["brand/view-trim?id=".$id]));
                }else{
                    Yii::$app->session->setFlash('success','Model added successfully.');
                    return $this->redirect(\Yii::$app->urlManager->createUrl(["brand/view-model?id=".$id]));
                }
            }else{
                echo '<pre>'; print_r($model->errors); die;
            }
            
        }else{
          return $this->render('sub_form',[
               'model' => $model ,
               'id' => $id 
           ]);
       }
    }
    public function actionUpdateSubcat($id){
        $model = $this->findModel($id);
        if ($model->load(Yii::$app->request->post())) {
            $model->url_safe = SiteUtil::getUrlFormate($_POST['Branddetails']['name']);
            if($model->save()){
                if(isset($_GET['ch']) && $_GET['ch']){
                    Yii::$app->session->setFlash('success','Sub Category Child added successfully.');
                    return $this->redirect(\Yii::$app->urlManager->createUrl(["brand/view-trim?id=".$model->parent_id]));
                }else{
                    Yii::$app->session->setFlash('success','Model added successfully.');
                    return $this->redirect(\Yii::$app->urlManager->createUrl(["brand/view-model?id=".$model->parent_id]));
                }
            }else{
                echo '<pre>'; print_r($model->errors); die;
            }
            
        } else {
            return $this->render('sub_form', [
                'model' => $model,
                'id' => $model->parent_id 
            ]);
        }
    }
    public function actionViewModel($id)
    {
        $searchModel = new BranddetailsSearch();
        $searchModel->parent_id = $id;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('model', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'id'=>$id,
        ]);
    }
    
    public function actionViewTrim($id)
    {
         $searchModel = new BranddetailsSearch();
        $searchModel->parent_id = $id;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('trim', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'id'=>$id,
        ]);
    }
}
