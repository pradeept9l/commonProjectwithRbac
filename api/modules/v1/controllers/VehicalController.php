<?php
namespace api\controllers\UserController;
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
        $this->modelClass = 'common\models\User';
        parent::init();
    }
    public function behaviors()
   {
       $behaviors = parent::behaviors();
       $behaviors['authenticator'] = [
           'class' => CompositeAuth::className(),
           'except' => [''],
           'authMethods' => [
               HttpBearerAuth::className(),
           ],
       ];
       $behaviors['contentNegotiator'] = [
           'class' => ContentNegotiator::className(),
           'formats' => [
               'application/json' => Response::FORMAT_JSON
           ],
       ];
       $behaviors['access'] = [
           'class' => AccessControl::className(),
           'rules' => [
                [
                    'actions' => [],
                    'allow' => true,
                ],
                [
                    'actions' => ['list'],
                    'allow' => true,
                    'roles' => ['admin', 'member']
                ]
           ],
       ];
       return $behaviors + [
           'verbs' => [
               'class' => \yii\filters\VerbFilter::className(),
               'actions' => [
                   'login' => ['POST'],
               ],
           ],
       ];
   }
   public function actionList(){
        echo "<pre>";print_r(Yii::$app->user->identity->id);die;
        $params = \Yii::$app->getRequest()->getBodyParams();
   }
   
}
