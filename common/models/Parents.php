<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "parents".
 *
 * @property int $id
 * @property string $father_name
 * @property string $mother_name
 * @property string $email
 * @property string $mobile_phone
 * @property string $home_phone
 *
 * @property Student[] $students
 */
class Parents extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'parents';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['father_name', 'mother_name', 'email'], 'required'],
            [['father_name', 'mother_name', 'email', 'mobile_phone', 'home_phone'], 'string', 'max' => 200],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('main', 'ID'),
            'father_name' => Yii::t('main', 'Father Name'),
            'mother_name' => Yii::t('main', 'Mother Name'),
            'email' => Yii::t('main', 'Email'),
            'mobile_phone' => Yii::t('main', 'Mobile Phone'),
            'home_phone' => Yii::t('main', 'Home Phone'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStudents()
    {
        return $this->hasMany(Student::className(), ['parent_id' => 'id']);
    }
}
