<?php 
namespace api\modules\v1\controllers;
use yii\rest\ActiveController;
use common\models\User;
use common\models\UserAuth;
use api\modules\v1\models\LoginForm;

class UserController extends \yii\rest\ActiveController
{
    public function init() {
        $this->modelClass = 'common\models\User';
        parent::init();
    }
    
    public function behaviors() {
        return [
            'verbs' => [
                'class' => \yii\filters\VerbFilter::className(),
                'actions' => [
                    'login' => ['POST', 'OPTIONS'],
                    'forgot' => ['POST', 'OPTIONS'],
                    'reset' => ['POST', 'OPTIONS'],
                    'logout' => ['get', 'OPTIONS'],
                    'change-password' => ['POST', 'OPTIONS'],
                    'logedin' => ['get', 'OPTIONS'],
                ],
            ]
        ];
    }
    
    public function actionLogin() {  
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON; // Send response in json
        $model = new LoginForm();
        $model->attributes = \Yii::$app->request->post();
        if($model->login()){
            $auth = UserAuth::saveAttribute($model->getUser());    // For save  User auth details.
            return array('status' => TRUE,'data' => $auth,'message' => 'Login Successfully');
        }else{
            $error =  array('status' => FALSE, 'message' => 'error','data'=>$model->getErrors());
            return $error;
        }
    }
    /*
     * Send user reset Password Mail.
     */
    public function actionForgot() { 
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        // $paramsResponse = $this->GetParams();
        $params = \Yii::$app->request->post();  
        if (!empty($params['useremail'])) { 
            $email = $params['useremail'];
            if (($user = User::find()->where(['email' => $email])->one()) !== null) { 
//                $this->ForgotPasswordMail($user); 
            }else{ 
                return array(400,'status' => FALSE,'message' => 'This email address is not registered with us');
            }
        }
        return array(400, 'status' => FALSE, 'message' => 'Email-ID can not be blank');
    }
    /*
     * For Set New Password.
     */
    public function actionReset() { 
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        // $paramsResponse = $this->GetParams();
        $params = \Yii::$app->request->post();  
        if (!empty($params['User']['repeatPassword']) && !empty($params['User']['password']) && !empty($params['User']['reset_token'])) {
            if ($params['User']['repeatPassword'] == $params['User']['password']) {
                $user = User::findOne(['password_reset_token' => $params['User']['reset_token']]);
                if ($user !== NULL) {
                    $user->scenario = User::SCENARIO_CHANGEPSW;
                    $user->setPassword($params['User']['password']);
                    $user->generateAuthKey();
                    if ($user->validate() && $user->save(false)) {
                        $data = ['status' => true, 'status_message' => 'success', 'message' => 'password Reset Successfully'];
                        $this->_sendResponse(200, array('data' => $data));
                    }else{
                         $error_message = 'Somthing went wrong try again';
                    }
                } else {
                    $error_message = 'User not found';
                }
            } else {
                $error_message = 'Password & repeatPassword must be same';
            }
        } else {
            $error_message = 'password, repeatPassword can not be empty';
        }
        $data = ['status' => FALSE, 'status_message' => 'error', 'message' => $error_message];
        $this->_sendResponse(200, array('data' => $data));
    }
    /*
     * Private function for send reset link to user
     */
//    public function actionList(){
//        
//    }
    /*
     * Private function for send reset link to user
     */
    
    private function ForgotPasswordMail($user) {   
         \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        if ( $user !== null) { 
             $user->scenario = 'resettoken';
                $user->password_reset_token = \yii::$app->security->generateRandomString(50);
                if ($user->update(false)) { 
                    $resetpswLink = \Yii::$app->params['angularFrontendurl']. 'reset-password/'. $user->password_reset_token;
                    $body = $this->renderPartial("mailer", ['name' => $user->fname,'link'=>$resetpswLink]);
                    $triggeremail = new CommonMailer($user->email, 'Investracker- Password Reset', $body);
                    $triggeremail->sendEmail();
                    $data = ['status' => TRUE, 'status_message' => 'success', 'messages' => 'Reset password link has been sent to your email.'];
                    $this->_sendResponse(200, array('data' => $data));

                }else{ 
                    return array('status' => FALSE, 'data'=>$model->getErrors(),'message' => 'This email address  is not registered with us');
                }
        }
        return array('status' => FALSE, 'data'=>$model->getErrors(),'message' => 'This email address is not registered with us');
    }
    /*
    *Logout
    */
    public function actionLogout(){ 
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $paramsResponse = $this->GetParams();
        $params = $paramsResponse['params'];
        if($this->userId){
            $auth = UserAuth::Logout($paramsResponse['authorization']);
            $data = ['status' => TRUE, 'status_message' => 'success', 'messages' => 'Logout.'];
            $this->_sendResponse(200, array('data' => $data));
        }
    }
    /*
    *Change password api
    */
    public function actionChangePassword() { 
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON; // Send response in json
        $model = new LoginForm();
        $paramsResponse = $this->GetParams();
        $params = $paramsResponse['params'];
        if($paramsResponse['authorization']){
            $user = User::find()->where(['id' => $this->userId])->one();
            $model->username = $user->email;
            $model->password = $params['old_password'];
            if($model->login()){
                $user->scenario = User::SCENARIO_CHANGEPSW;
                $user->setPassword($params['password']);
                $user->generateAuthKey();
                if ($user->validate() && $user->save(false)) {
                    $data = ['status' => true, 'status_message' => 'success', 'message' => 'password change Successfully'];
                    $this->_sendResponse(200, array('data' => $data));
                }else{
                        $error_message = 'Somthing went wrong try again';
                }
            }else{
                $error_message =  array('status' => FALSE, 'message' => 'error','data'=>$model->getErrors());
                
            }
        }else{
            $error_message = array('data' => 'not a valid Authntication');
        }
        $data = ['status' => FALSE, 'status_message' => 'error', 'message' => $error_message];
        $this->_sendResponse(200, array('data' => $data));
        
    }
    public function actionLogedin(){
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $paramsResponse = $this->GetParams();
        $params = $paramsResponse['params'];
        if($this->userId){
            $data = ['status' => TRUE, 'status_message' => 'success', 'messages' => 'Is LogedIn.'];
            $this->_sendResponse(200, array('data' => $data));
        }else{
            $data = ['status' => FALSE, 'status_message' => 'success', 'messages' => 'Not LogedIn.'];
            $this->_sendResponse(401, array('data' => $data));
        }
    }
    
    
}
