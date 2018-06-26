<?php
namespace api\modules\v1\controllers;
use yii\rest\ActiveController;
use common\models\User;
use common\models\Vehical;
use yii\filters\auth\HttpBearerAuth;
use yii\filters\ContentNegotiator;
use yii\web\Response;
use yii\filters\auth\CompositeAuth;
use yii\filters\AccessControl;

class VehicalController extends \yii\rest\ActiveController
{
    public function init() {
        $this->modelClass = 'common\models\Vehical';
        parent::init();
    }
    public function behaviors() {
        return [
            'verbs' => [
                'class' => \yii\filters\VerbFilter::className(),
                'actions' => [
                    'list' => ['POST', 'OPTIONS'],
//                    'forgot' => ['POST', 'OPTIONS'],
//                    'reset' => ['POST', 'OPTIONS'],
//                    'logout' => ['get', 'OPTIONS'],
//                    'change-password' => ['POST', 'OPTIONS'],
//                    'logedin' => ['get', 'OPTIONS'],
                ],
            ]
        ];
    }
   public function actionList($id) { echo '<pre>'; print_r(\Yii::$app->user->identity->fname); die;
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $paramsResponse = $this->GetParams();
        if($this->userId){ 
            $incode = base64_encode($id);
            $url =  Yii::$app->request->hostInfo . '/v1/site/generate-doc?id='.$incode;
            $data = ['status' => TRUE, 'status_message' => 'Startup list', 'data' => $url];
            return $data;
            \Yii::$app->end();
        }
        return ['status' => FALSE, 'status_message' => 'You are not authorized person'];
    }
    public function actionBrands() {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $paramsResponse = $this->GetParams();
        if($this->userId){ 
            $incode = base64_encode($id);
            $url =  Yii::$app->request->hostInfo . '/v1/site/generate-doc?id='.$incode;
            $data = ['status' => TRUE, 'status_message' => 'Startup list', 'data' => $url];
            return $data;
            \Yii::$app->end();
        }
        return ['status' => FALSE, 'status_message' => 'You are not authorized person'];
    }
    public function actionModel($brandid) {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $paramsResponse = $this->GetParams();
        if($this->userId){ 
            $incode = base64_encode($id);
            $url =  Yii::$app->request->hostInfo . '/v1/site/generate-doc?id='.$incode;
            $data = ['status' => TRUE, 'status_message' => 'Startup list', 'data' => $url];
            return $data;
            \Yii::$app->end();
        }
        return ['status' => FALSE, 'status_message' => 'You are not authorized person'];
    }
    public function actionTrim($brandid) {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $paramsResponse = $this->GetParams();
        if($this->userId){ 
            $incode = base64_encode($id);
            $url =  Yii::$app->request->hostInfo . '/v1/site/generate-doc?id='.$incode;
            $data = ['status' => TRUE, 'status_message' => 'Startup list', 'data' => $url];
            return $data;
            \Yii::$app->end();
        }
        return ['status' => FALSE, 'status_message' => 'You are not authorized person'];
    }
   
}
