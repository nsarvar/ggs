<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "student".
 *
 * @property int $id
 * @property string $code
 * @property string $fname
 * @property string $lname
 * @property string $bdate
 * @property string $email
 * @property string $passport
 * @property string $address
 * @property string $phone
 * @property int $parent_id
 * @property string $created_at
 * @property string $updated_at
 *
 * @property CourseEnroll[] $courseEnrolls
 * @property Grades[] $grades
 * @property Parent $parent
 */
class Student extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'student';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['code', 'fname', 'lname', 'bdate', 'email', 'passport', 'address', 'phone', 'created_at', 'updated_at'], 'required'],
            [['bdate', 'created_at', 'updated_at'], 'safe'],
            [['address'], 'string'],
            [['parent_id'], 'integer'],
            [['code', 'fname', 'lname'], 'string', 'max' => 50],
            [['email'], 'string', 'max' => 100],
            ['email','email'],
            [['passport', 'phone'], 'string', 'max' => 20],
            [['parent_id'], 'exist', 'skipOnError' => true, 'targetClass' => Parent::className(), 'targetAttribute' => ['parent_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('main', 'ID'),
            'code' => Yii::t('main', 'Code'),
            'fname' => Yii::t('main', 'Fname'),
            'lname' => Yii::t('main', 'Lname'),
            'bdate' => Yii::t('main', 'Bdate'),
            'email' => Yii::t('main', 'Email'),
            'passport' => Yii::t('main', 'Passport'),
            'address' => Yii::t('main', 'Address'),
            'phone' => Yii::t('main', 'Phone'),
            'parent_id' => Yii::t('main', 'Parent ID'),
            'created_at' => Yii::t('main', 'Created At'),
            'updated_at' => Yii::t('main', 'Updated At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCourseEnrolls()
    {
        return $this->hasMany(CourseEnroll::className(), ['student_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGrades()
    {
        return $this->hasMany(Grades::className(), ['student_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParent()
    {
        return $this->hasOne(Parent::className(), ['id' => 'parent_id']);
    }
}
