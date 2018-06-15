<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
/**
 * This is the model class for table "tbl_weightage".
 *
 * @property int $id
 * @property int $v_id
 * @property int $cat_id
 * @property int $weightage
 * @property int $created_at
 * @property int $updated_at
 * @property int $status
 */
class Weightage extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_weightage';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['v_id',], 'required'],
            [['v_id', 'cat_id', 'weightage', 'created_at', 'updated_at', 'status'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'v_id' => 'V ID',
            'cat_id' => 'Cat ID',
            'weightage' => 'Weightage',
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
}
