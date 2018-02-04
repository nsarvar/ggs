<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "faculty".
 *
 * @property int $id
 * @property string $fname
 * @property string $lname
 * @property string $email
 * @property string $phone
 * @property string $address
 * @property int $full_available
 * @property string $created_at
 * @property string $updated_at
 *
 * @property FacultyCourse[] $facultyCourses
 * @property FacultyHours[] $facultyHours
 */
class Faculty extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'faculty';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['fname', 'lname', 'email', 'phone', 'address', 'full_available', 'created_at', 'updated_at'], 'required'],
            [['full_available'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['fname', 'lname', 'phone', 'address'], 'string', 'max' => 50],
            [['email'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('main', 'ID'),
            'fname' => Yii::t('main', 'Fname'),
            'lname' => Yii::t('main', 'Lname'),
            'email' => Yii::t('main', 'Email'),
            'phone' => Yii::t('main', 'Phone'),
            'address' => Yii::t('main', 'Address'),
            'full_available' => Yii::t('main', 'Full Available'),
            'created_at' => Yii::t('main', 'Created At'),
            'updated_at' => Yii::t('main', 'Updated At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFacultyCourses()
    {
        return $this->hasMany(FacultyCourse::className(), ['faculty_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFacultyHours()
    {
        return $this->hasMany(FacultyHours::className(), ['faculty_id' => 'id']);
    }
}
