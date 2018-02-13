<?php

namespace common\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "subject".
 *
 * @property int $id
 * @property int $parent_id
 * @property string $name
 *
 * @property Course[] $courses
 */
class Subject extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'subject';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 50],
            [['parent_id'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('main', 'ID'),
            'name' => Yii::t('main', 'Name'),
            'parent_id' => Yii::t('main', 'Parent Subject'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCourses()
    {
        return $this->hasMany(Course::className(), ['subject_id' => 'id']);
    }

    public static function getModelsAsArray() {
        $models = Subject::find()->asArray()->all();
        return $models;
    }

    public static function getModelsAsMap() {
        $models = Subject::find()->all();
        return ArrayHelper::map($models,'id','name');
    }

    public static function getMainSubjectsAsMap()
    {
        $models = Subject::find()->andWhere(['parent_id' => null])->all();
        return ArrayHelper::map($models,'id' ,'name');
    }

    public function getParent()
    {
        $model = Subject::findOne($this->parent_id);
        if(!empty($model->name))
            return $model->name;
        return false;
    }
}
