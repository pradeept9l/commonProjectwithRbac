<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "tbl_user_auth".
 *
 * @property int $id
 * @property int $user_id
 * @property string $auth_key
 * @property int $created_at
 * @property int $updated_at
 * @property int $status
 */
class UserAuth extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    const STATUS_DELETED = 0;
    const STATUS_LOGOUT = 1;
    const STATUS_LOGIN = 10;
    public $user;
    public static function tableName()
    {
        return 'tbl_user_auth';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'auth_key'], 'required'],
            [['user_id', 'created_at', 'updated_at', 'status'], 'integer'],
            [['auth_key'], 'string'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'auth_key' => 'Auth Key',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'status' => 'Status',
        ];
    }
     /**
     * Returns a list of behaviors that this component should behave as.
     *
     * @return array
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }
    /*
     * Get User details
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
    /*
     * set UserAuth form attribute
     */
    public function _setAttribute($user) {
        $this->user_id = $user->id;
        $this->auth_key =  \Yii::$app->security->generateRandomString();  
        $this->status = self::STATUS_LOGIN;
    }
    /*
     * Save userAuth attributes and send userinfo in response
     */
    public static function saveAttribute($user) { 
        $ifExists = self::find()->where(['user_id' => $user->id])->andWhere(['status' => self::STATUS_LOGIN])->one();
        $model = new UserAuth();
        if($ifExists){
            $ifExists->status = self::STATUS_LOGOUT;
            $ifExists->save();
        }
        $model->_setAttribute($user);
        if($model->save()){
            return array('name' => $user->fname.' '.$user->lname,
            'access_token' => $model->auth_key,
            'role' => $user->getRoleName());
        }else{
            return array('status' => FALSE, 'data' => $model->errors);
        }
        
    }
    /*
     * clear userAuth info 
     */
    public static function Logout($auth) { 
        $authorizationCode = $auth;
        $decodedArray = explode(' ', $authorizationCode);
        $ifExists = self::find()->where(['auth_key' => $decodedArray[1]])->one();
        if($ifExists){
            $ifExists->status = self::STATUS_LOGOUT;
            $ifExists->save();
            return true;
        }        
    }
}
