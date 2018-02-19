<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "mysubject".
 *
 * @property int $id
 * @property int $parent_id
 * @property int $sub_subject_id
 * @property int $type
 * @property int $status
 */
class Mysubject extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'mysubject';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['parent_id', 'sub_subject_id', 'type', 'status'], 'required'],
            [['parent_id', 'sub_subject_id', 'type', 'status'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('main', 'ID'),
            'parent_id' => Yii::t('main', 'Parent ID'),
            'sub_subject_id' => Yii::t('main', 'Sub Subject ID'),
            'type' => Yii::t('main', 'Type'),
            'status' => Yii::t('main', 'Status'),
        ];
    }
}
