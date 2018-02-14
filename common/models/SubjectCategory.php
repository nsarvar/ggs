<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "subject_category".
 *
 * @property int $id
 * @property int $subject_id
 * @property int $category_id
 *
 * @property Category $category
 * @property Subject $subject
 */
class SubjectCategory extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'subject_category';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['subject_id', 'category_id'], 'required'],
            [['subject_id', 'category_id'], 'integer'],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['category_id' => 'id']],
            [['subject_id'], 'exist', 'skipOnError' => true, 'targetClass' => Subject::className(), 'targetAttribute' => ['subject_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('main', 'ID'),
            'subject_id' => Yii::t('main', 'Subject ID'),
            'category_id' => Yii::t('main', 'Category ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'category_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSubject()
    {
        return $this->hasOne(Subject::className(), ['id' => 'subject_id']);
    }

    public static function hasModel($subject_id, $category_id){
        return SubjectCategory::find()->andFilterWhere(['subject_id' => $subject_id, 'category_id' => $category_id])->exists();
    }

    public static function saveModel($subject_id, $category_id) {
        if(!SubjectCategory::hasModel($subject_id,$category_id)) {
            $model = new SubjectCategory();
            $model->subject_id = $subject_id;
            $model->category_id = $category_id;
            $model->save();
        }
    }

    public static function getModel($subject_id, $category_id) {
        if(SubjectCategory::hasModel($subject_id,$category_id))
            return SubjectCategory::find()->andFilterWhere(['subject_id' => $subject_id, 'category_id' => $category_id])->one();
        return false;
    }

    public static function deleteModel($subject_id, $category_id) {
        if(SubjectCategory::hasModel($subject_id, $category_id)) {
            $model = SubjectCategory::getModel($subject_id,$category_id);
            $model->delete();
        }
    }

}
