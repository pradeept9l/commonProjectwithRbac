<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "tbl_vehical".
 *
 * @property int $id
 * @property string $name
 * @property int $brand_id
 * @property int $model_id
 * @property int $trim_id
 * @property int $color_id
 * @property int $fuel 1 => Diesel, 2=> Petrol
 * @property int $year
 * @property int $no_of_owner
 * @property int $created_at
 * @property int $updated_at
 * @property int $status
 *
 * @property TblBranddetails $brand
 */
class Vehical extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_vehical';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'brand_id', 'model_id', 'status'], 'required'],
            [['brand_id', 'model_id', 'trim_id', 'color_id', 'fuel', 'year', 'no_of_owner', 'created_at', 'updated_at', 'status'], 'integer'],
            [['name'], 'string', 'max' => 500],
            [['brand_id'], 'exist', 'skipOnError' => true, 'targetClass' => Branddetails::className(), 'targetAttribute' => ['brand_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'brand_id' => 'Brand ID',
            'model_id' => 'Model ID',
            'trim_id' => 'Trim ID',
            'color_id' => 'Color ID',
            'fuel' => 'Fuel',
            'year' => 'Year',
            'no_of_owner' => 'No Of Owner',
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

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBrand()
    {
        return $this->hasOne(Branddetails::className(), ['id' => 'brand_id']);
    }
}
