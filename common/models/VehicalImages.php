<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "tbl_vehical_images".
 *
 * @property int $id
 * @property string $imagename
 * @property int $type
 * @property int $vehical_id
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

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['imagename', 'created_at', 'updated_at', 'status'], 'required'],
            [['imagename'], 'string'],
            [['type', 'vehical_id', 'created_at', 'updated_at', 'status'], 'integer'],
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
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'status' => 'Status',
        ];
    }
}
