<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "tbl_vehical_images".
 *
 * @property int $id
 * @property string $imagename
 * @property int $type
 * @property int $vehical_id
 * @property int $cat_id
 * @property int $attr_id
 * @property string $file_icon
 * @property int $created_at
 * @property int $updated_at
 * @property int $status
 */
class VehicalImages extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_vehical_images';
    }
    const STATUS_ACTIVE = 1;
    const STATUS_INACTIVE = 0;
    const DOC_TYPES = 1;
    const IMAGE_TYPES = 2;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['imagename'], 'string'],
            [['type', 'vehical_id', 'cat_id', 'attr_id', 'created_at', 'updated_at', 'status'], 'integer'],
            [['file_icon'], 'string', 'max' => 200],
            [['imagename'],'file'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'imagename' => 'Imagename',
            'type' => 'Type',
            'vehical_id' => 'Vehical ID',
            'cat_id' => 'Cat ID',
            'attr_id' => 'Attr ID',
            'file_icon' => 'File Icon',
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
    public static function setImageAttribute($name, $value,$ext) {  
        $allreadyexit = VehicalImages::find()->where(['vehical_id' => $value['v_id'],'attr_id' => $value['attribute_id']])->andWhere(['status' => self::STATUS_ACTIVE])->all();
        if($allreadyexit){
            foreach($allreadyexit as $img){
                $img->status = 0;
                $img->save(false);
            }
        }
        $model = new VehicalImages();
        $model->imagename = $name;
        $model->type = 1;
        $model->vehical_id = $value['v_id'];
        $model->cat_id = $value['cat_id'];
        $model->attr_id = $value['attribute_id'];
        $model->file_icon = $ext.'.png';
        $model->status = self::STATUS_ACTIVE;
        if($model->save()){
            return TRUE;
        }else{
            echo '<pre>'; print_r($model->errors); die;
        }
    }
    public static function saveMultipleImages($name, $value,$ext) {  
        $model = new VehicalImages();
        $model->imagename = $name;
        $model->type = self::IMAGE_TYPES;
        $model->vehical_id = $value['vehical_id'];
        $model->cat_id = $value['cat_id'];
        $model->attr_id = $value['attr_id'];
        $model->file_icon = $ext.'.png';
        $model->status = self::STATUS_ACTIVE;
        if($model->save()){
            return TRUE;
        }else{
            echo '<pre>'; print_r($model->errors); die;
        }
    }
}
