<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "sub_subject".
 *
 * @property int $id
 * @property int $subject_id
 * @property string $name
 *
 * @property Groups[] $groups
 * @property Subject $subject
 */
class SubSubject extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sub_subject';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['subject_id', 'name'], 'required'],
            [['subject_id'], 'integer'],
            [['name'], 'string', 'max' => 64],
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
            'name' => Yii::t('main', 'Name'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGroups()
    {
        return $this->hasMany(Groups::className(), ['sub_subject_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSubject()
    {
        return $this->hasOne(Subject::className(), ['id' => 'subject_id']);
    }
}
