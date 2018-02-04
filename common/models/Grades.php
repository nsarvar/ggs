<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "grades".
 *
 * @property int $id
 * @property int $exam_id
 * @property int $course_id
 * @property int $student_id
 * @property int $grade
 *
 * @property Course $course
 * @property Exam $exam
 * @property Student $student
 */
class Grades extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'grades';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['exam_id', 'course_id', 'student_id', 'grade'], 'required'],
            [['exam_id', 'course_id', 'student_id', 'grade'], 'integer'],
            [['course_id'], 'exist', 'skipOnError' => true, 'targetClass' => Course::className(), 'targetAttribute' => ['course_id' => 'id']],
            [['exam_id'], 'exist', 'skipOnError' => true, 'targetClass' => Exam::className(), 'targetAttribute' => ['exam_id' => 'id']],
            [['student_id'], 'exist', 'skipOnError' => true, 'targetClass' => Student::className(), 'targetAttribute' => ['student_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('main', 'ID'),
            'exam_id' => Yii::t('main', 'Exam ID'),
            'course_id' => Yii::t('main', 'Course ID'),
            'student_id' => Yii::t('main', 'Student ID'),
            'grade' => Yii::t('main', 'Grade'),
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
    public function getExam()
    {
        return $this->hasOne(Exam::className(), ['id' => 'exam_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStudent()
    {
        return $this->hasOne(Student::className(), ['id' => 'student_id']);
    }
}
