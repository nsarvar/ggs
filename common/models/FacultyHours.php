<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "faculty_hours".
 *
 * @property int $id
 * @property int $faculty_id
 * @property int $weekday
 * @property string $start_time
 * @property string $end_time
 *
 * @property Faculty $faculty
 */
class FacultyHours extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'faculty_hours';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['faculty_id', 'weekday', 'start_time', 'end_time'], 'required'],
            [['faculty_id', 'weekday'], 'integer'],
            [['start_time', 'end_time'], 'safe'],
            [['faculty_id'], 'exist', 'skipOnError' => true, 'targetClass' => Faculty::className(), 'targetAttribute' => ['faculty_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('main', 'ID'),
            'faculty_id' => Yii::t('main', 'Faculty ID'),
            'weekday' => Yii::t('main', 'Weekday'),
            'start_time' => Yii::t('main', 'Start Time'),
            'end_time' => Yii::t('main', 'End Time'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFaculty()
    {
        return $this->hasOne(Faculty::className(), ['id' => 'faculty_id']);
    }
}
