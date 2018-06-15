<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\web\UploadedFile;

/**
 * This is the model class for table "tbl_uploadfile".
 *
 * @property integer $id
 * @property string $File_name
 */



class Uploadfile extends \yii\db\ActiveRecord
{
    public $files;
    public $pfiles;
    public $mfiles;
    public $sfiles;

   /**
     * @var UploadedFile
     */
    public static function tableName()
    {
        return 'tbl_products';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
//            [['File_name'], 'string'],
//            [['imageFile'], 'file', 'skipOnEmpty' => false, 'extensions' => 'xls, xlsx, csv, jpg, jpeg, png'],
            [['files'], 'file','maxFiles' => 20],
            [['sfiles'], 'file','maxFiles' => 20],
            [['pfiles','mfiles'], 'file',],
            
        ];
    }
     

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'File_name' => 'File Name',
        ];
    }
}
