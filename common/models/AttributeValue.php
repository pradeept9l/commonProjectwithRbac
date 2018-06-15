<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\web\UploadedFile;
/**
 * This is the model class for table "tbl_attribute_value".
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
 * @property SubcatAttribute $attribute0
 * @property Category $cat
 * @property Subcategory $subcat
 * @property Vehical $v
 */
class AttributeValue extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public $image;
    public static function tableName()
    {
        return 'tbl_attribute_value';
    }
    const STATUS_DELETED = 2;
    const STATUS_NOT_ACTIVE = 0;
    const STATUS_ACTIVE = 1;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['v_id', 'cat_id',], 'required'],
            [['v_id', 'cat_id', 'subcat_id', 'attribute_id', 'answer', 'repair_Cost', 'created_at', 'updated_at', 'status'], 'integer'],
            [['comments', 'score', 'ifissue'], 'string', 'max' => 500],
            [['attribute_id'], 'exist', 'skipOnError' => true, 'targetClass' => SubcatAttribute::className(), 'targetAttribute' => ['attribute_id' => 'id']],
            [['cat_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['cat_id' => 'id']],
            [['subcat_id'], 'exist', 'skipOnError' => true, 'targetClass' => Subcategory::className(), 'targetAttribute' => ['subcat_id' => 'id']],
            [['v_id'], 'exist', 'skipOnError' => true, 'targetClass' => Vehical::className(), 'targetAttribute' => ['v_id' => 'id']],
            [['image'],'file'],
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
    public function getAttribute0()
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
    public static function saveValue($id){
        $category = Category::find()->where(['status' => self::STATUS_ACTIVE])->all();
        foreach ($category as $key => $cat){
            $subcat = Subcategory::find()->where(['status' => self::STATUS_ACTIVE,'cat_id' => $cat->id])->all();
            foreach($subcat as $_subcat){
                $catattr = SubcatAttribute::find()->where(['status' => self::STATUS_ACTIVE,'subcat_id' => $_subcat->id])->all();
                foreach ($catattr as $attr){
                    $model = new AttributeValue();
                    $model->v_id = $id;
                    $model->cat_id = $cat->id;
                    $model->subcat_id = $_subcat->id;
                    $model->attribute_id = $attr->id;
                    $model->answer = self::STATUS_ACTIVE;
                    $model->status = self::STATUS_ACTIVE;
                    $model->save();
                }
            }
        }
        return TRUE;
    }
    public static function updateValue($params){
        $model = AttributeValue::find()->where(['id'=>$params['id']])->andWhere(['v_id' => $params['v_id']])->one();
        $model->answer = $params['answer'];
        $model->comments = $params['comments'];
        $model->ifissue = $params['ifissue'];
        $model->repair_Cost = $params['repair_Cost'];
        $model->score = $params['score'];
        $model->status = self::STATUS_ACTIVE;
        $model->save();
        return TRUE;
    }
}
