<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "times".
 *
 * @property int $id
 * @property int $parent_id
 * @property int $weekday
 * @property int $time
 * @property int $type
 * @property int $status
 */
class Times extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'times';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['parent_id', 'weekday', 'time', 'type', 'status'], 'required'],
            [['parent_id', 'weekday', 'time', 'type', 'status'], 'integer'],
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
            'weekday' => Yii::t('main', 'Weekday'),
            'time' => Yii::t('main', 'Time'),
            'type' => Yii::t('main', 'Type'),
            'status' => Yii::t('main', 'Status'),
        ];
    }
}
