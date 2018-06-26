<?php 
namespace api\modules\v1\controllers;
use yii\rest\ActiveController;
use common\models\User;
use common\models\UserAuth;
use api\modules\v1\models\LoginForm;
use common\models\Branddetails;

class BrandController extends \yii\rest\ActiveController
{
    public function init() {
        $this->modelClass = 'common\models\Model';
        parent::init();
    }
    
    public function behaviors() {
        return [
            'verbs' => [
                'class' => \yii\filters\VerbFilter::className(),
                'actions' => [
                    'logedin' => ['get', 'OPTIONS'],
                ],
            ]
        ];
    }
    
        
}
