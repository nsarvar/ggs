<?php

namespace common\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "course_group".
 *
 * @property int $id
 * @property string $name
 * @property int $size
 */
class CourseGroup extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'course_group';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'size'], 'required'],
            [['size'], 'integer'],
            [['name'], 'string', 'max' => 20],
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
            'size' => Yii::t('main', 'Size Group'),
        ];
    }

    public static function getAllModelsAsMap() {
        $models = CourseGroup::find()->all();
        return ArrayHelper::map($models,'id','name');
    }

}
