<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "schedule".
 *
 * @property int $id
 * @property int $course_id
 * @property string $day
 * @property string $start_time
 * @property string $end_time
 *
 * @property Course $course
 */
class Schedule extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'schedule';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['course_id', 'day', 'start_time', 'end_time'], 'required'],
            [['course_id'], 'integer'],
            [['start_time', 'end_time'], 'safe'],
            [['day'], 'string', 'max' => 1],
            [['course_id'], 'exist', 'skipOnError' => true, 'targetClass' => Course::className(), 'targetAttribute' => ['course_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('main', 'ID'),
            'course_id' => Yii::t('main', 'Course ID'),
            'day' => Yii::t('main', 'Day'),
            'start_time' => Yii::t('main', 'Start Time'),
            'end_time' => Yii::t('main', 'End Time'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCourse()
    {
        return $this->hasOne(Course::className(), ['id' => 'course_id']);
    }
}
