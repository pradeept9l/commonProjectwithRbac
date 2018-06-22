<?php

namespace api\modules\v1\models;

use Yii;
use yii\base\Model;
use yii\web\UploadedFile;
/**
 * Login form
 */
class uploadfile extends \yii\db\ActiveRecord {

    public $uploadFile;
    public $files;
    public $imagefile;
    public $videofile;
  
public static function tableName()
    {
        return 'deal_documents';
    }
    /**
     * @inheritdoc
     */
    public function rules() {
        return [
           [['uploadFile'], 'required'],
           [['uploadFile'], 'file', 'extensions' => 'csv,xlsx,xls'],
           [['files'], 'file','maxFiles' => 20],
           [['imagefile'], 'file',],
           [['videofile'], 'file',],
        ];
    }
    
//     public function upload()
//    {
//        $file_move_to = Yii::$app->basePath.'/web/others/';
//        if ($this->validate([$this->uploadFile])) {
//            
//            $upload_file = time(). '.' . $this->uploadFile->extension;
//            $this->uploadFile->saveAs($file_move_to.$upload_file);
////            $this->resource_name = $upload_file;
////            $this->resource_type = $this->uploadFile->extension;
//            return true;
//        } else {
//            return false;
//        }
//    }
    

   
}
