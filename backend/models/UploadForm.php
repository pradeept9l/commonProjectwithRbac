<?php 
namespace backend\models;

use yii\base\Model;
use yii\web\UploadedFile;
/**
 * This is the model class for table "tbl_uploadfile".
 *
 * @property integer $id
 * @property string $File_name
 */

class UploadForm extends Model
{
    /**
     * @var UploadedFile
     */
    public $imageFile;
    public static function tableName()
    {
        return 'tbl_uploadfile';
    }

   public function rules()
    {
        return [
            [['File_name'], 'string'],
            [['imageFile'], 'file', 'skipOnEmpty' => false, 'extensions' => 'xls, xlsx, csv'],
        ];
    }
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'File_name' => 'File Name',
        ];
    }

    public function upload()
    {
        if ($this->validate()) {
            $this->imageFile->saveAs('uploads/' . $this->imageFile->baseName . '.' . $this->imageFile->extension);
            
            return true ;
            return $name;
            
        } else {
            return false;
        }
    }
}