<?php

namespace backend\controllers;

use Yii;
use common\models\Vehical;
use common\models\VehicalSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\Branddetails;
use common\models\VehicalWeightage;

/**
 * VehicalController implements the CRUD actions for Vehical model.
 */
class VehicalController extends Controller
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
        return $this->render('view', [
            'model' => $this->findModel($id),
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
        $subcatattr = new \common\models\SubcatAttribute();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
            'attr'  => $subcatattr,
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

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
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
}
