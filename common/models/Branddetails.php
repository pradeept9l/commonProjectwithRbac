<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "tbl_branddetails".
 *
 * @property int $id
 * @property string $name
 * @property int $parent_id
 * @property int $created_at
 * @property int $updated_at
 * @property int $status
 *
 * @property TblVehical[] $tblVehicals
 */
class Branddetails extends \yii\db\ActiveRecord
{
    const STATUS_DELETED = 2;
    const STATUS_NOT_ACTIVE = 0;
    const STATUS_ACTIVE = 1;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_branddetails';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'status'], 'required'],
            [['parent_id', 'created_at', 'updated_at', 'status'], 'integer'],
            [['name','url_safe'], 'string', 'max' => 500],
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
            'parent_id' => 'Parent Name',
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
    public function getTblVehicals()
    {
        return $this->hasMany(TblVehical::className(), ['brand_id' => 'id']);
    }
    public function getStatusList()
    {
        $statusArray = [
            self::STATUS_ACTIVE     => 'Active',
            self::STATUS_NOT_ACTIVE => 'Inactive',
            self::STATUS_DELETED    => 'Deleted'
        ];

        return $statusArray;
    }
    /*
     * Get Parent Details
     */
    public function getParent()
    {
       return $this->hasOne(Branddetails::className(),['id'=>'parent_id']);  
    }
}
