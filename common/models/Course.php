<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "course".
 *
 * @property int $id
 * @property int $subject_id
 * @property string $title
 * @property string $desciption
 * @property string $other_detail
 *
 * @property Subject $subject
 * @property CourseEnroll[] $courseEnrolls
 * @property Exam[] $exams
 * @property FacultyCourse[] $facultyCourses
 * @property Grades[] $grades
 * @property Schedule[] $schedules
 */
class Course extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'course';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['subject_id', 'title', 'desciption', 'other_detail'], 'required'],
            [['subject_id'], 'integer'],
            [['desciption', 'other_detail'], 'string'],
            [['title'], 'string', 'max' => 200],
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
            'title' => Yii::t('main', 'Title'),
            'desciption' => Yii::t('main', 'Desciption'),
            'other_detail' => Yii::t('main', 'Other Detail'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSubject()
    {
        return $this->hasOne(Subject::className(), ['id' => 'subject_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCourseEnrolls()
    {
        return $this->hasMany(CourseEnroll::className(), ['course_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getExams()
    {
        return $this->hasMany(Exam::className(), ['course_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFacultyCourses()
    {
        return $this->hasMany(FacultyCourse::className(), ['course_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGrades()
    {
        return $this->hasMany(Grades::className(), ['course_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSchedules()
    {
        return $this->hasMany(Schedule::className(), ['course_id' => 'id']);
    }
}
