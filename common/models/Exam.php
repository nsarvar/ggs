<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "exam".
 *
 * @property int $id
 * @property int $course_id
 * @property string $exam_date
 * @property string $title
 * @property string $description
 *
 * @property Course $course
 * @property Grades[] $grades
 */
class Exam extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'exam';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['course_id', 'exam_date', 'title', 'description'], 'required'],
            [['course_id'], 'integer'],
            [['exam_date'], 'safe'],
            [['description'], 'string'],
            [['title'], 'string', 'max' => 250],
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
            'exam_date' => Yii::t('main', 'Exam Date'),
            'title' => Yii::t('main', 'Title'),
            'description' => Yii::t('main', 'Description'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCourse()
    {
        return $this->hasOne(Course::className(), ['id' => 'course_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGrades()
    {
        return $this->hasMany(Grades::className(), ['exam_id' => 'id']);
    }
}
