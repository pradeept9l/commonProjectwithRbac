<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "tbl_vehical_weightage".
 *
 * @property int $id
 * @property int $v_id
 * @property int $cat_id
 * @property int $subcat_id
 * @property int $attribute_id
 * @property int $answer 1=> Yes, 0=> NO
 * @property string $comments
 * @property int $repair_Cost
 * @property string $score
 * @property string $ifissue
 * @property int $created_at
 * @property int $updated_at
 * @property int $status
 *
 * @property TblSubcatAttribute $attribute0
 * @property TblCategory $cat
 * @property TblSubcategory $subcat
 * @property TblVehical $v
 */
class VehicalWeightage extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_vehical_weightage';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['v_id', 'cat_id', 'subcat_id', 'attribute_id', 'created_at', 'updated_at', 'status'], 'required'],
            [['v_id', 'cat_id', 'subcat_id', 'attribute_id', 'answer', 'repair_Cost', 'created_at', 'updated_at', 'status'], 'integer'],
            [['comments', 'score', 'ifissue'], 'string', 'max' => 500],
            [['attribute_id'], 'exist', 'skipOnError' => true, 'targetClass' => SubcatAttribute::className(), 'targetAttribute' => ['attribute_id' => 'id']],
            [['cat_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['cat_id' => 'id']],
            [['subcat_id'], 'exist', 'skipOnError' => true, 'targetClass' => Subcategory::className(), 'targetAttribute' => ['subcat_id' => 'id']],
            [['v_id'], 'exist', 'skipOnError' => true, 'targetClass' => Vehical::className(), 'targetAttribute' => ['v_id' => 'id']],
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
            'subcat_id' => 'Subcat ID',
            'attribute_id' => 'Attribute ID',
            'answer' => 'Answer',
            'comments' => 'Comments',
            'repair_Cost' => 'Repair  Cost',
            'score' => 'Score',
            'ifissue' => 'Ifissue',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'status' => 'Status',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAttribute()
    {
        return $this->hasOne(SubcatAttribute::className(), ['id' => 'attribute_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCat()
    {
        return $this->hasOne(Category::className(), ['id' => 'cat_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSubcat()
    {
        return $this->hasOne(Subcategory::className(), ['id' => 'subcat_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getV()
    {
        return $this->hasOne(Vehical::className(), ['id' => 'v_id']);
    }
}
