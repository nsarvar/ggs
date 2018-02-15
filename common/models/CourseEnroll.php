<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "course_enroll".
 *
 * @property int $course_id
 * @property int $student_id
 *
 * @property Course $course
 * @property Student $student
 */
class CourseEnroll extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'course_enroll';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['course_id', 'student_id'], 'required'],
            [['course_id', 'student_id'], 'integer'],
            [['course_id'], 'exist', 'skipOnError' => true, 'targetClass' => Course::className(), 'targetAttribute' => ['course_id' => 'id']],
            [['student_id'], 'exist', 'skipOnError' => true, 'targetClass' => Student::className(), 'targetAttribute' => ['student_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'course_id' => Yii::t('main', 'Course ID'),
            'student_id' => Yii::t('main', 'Student ID'),
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
    public function getStudent()
    {
        return $this->hasOne(Student::className(), ['id' => 'student_id']);
    }

    public static function hasModel($course, $student) {
        return CourseEnroll::find()->andFilterWhere(['course_id' => $course, 'student_id' => $student])->exists();
    }

    public static function getModel($course, $student) {
        if(CourseEnroll::hasModel($course,$student)) {
            return CourseEnroll::find()->andFilterWhere(['course_id' => $course, 'student_id' => $student])->one();
        }
        return false;
    }

    public static function saveModel($course, $student) {
        if(!empty(Course::findOne($course)) && !empty(Student::findOne($student)) && !CourseEnroll::hasModel($course, $student)) {
            $model = new CourseEnroll();
            $model->course_id = $course;
            $model->student_id = $student;
            return $model->save();
        }
        return false;
    }

    public static function deleteModel($course, $student) {
        if(CourseEnroll::hasModel($course, $student)) {
            return CourseEnroll:: deleteAll(['course_id' => $course,'student_id' => $student]);
        }
        return false;
    }

}
