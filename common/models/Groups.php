<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "groups".
 *
 * @property int $id
 * @property int $sub_subject_id
 * @property string $name
 *
 * @property SubSubject $subSubject
 */
class Groups extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'groups';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['sub_subject_id', 'name'], 'required'],
            [['sub_subject_id'], 'integer'],
            [['name'], 'string', 'max' => 64],
            [['sub_subject_id'], 'exist', 'skipOnError' => true, 'targetClass' => SubSubject::className(), 'targetAttribute' => ['sub_subject_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('main', 'ID'),
            'sub_subject_id' => Yii::t('main', 'Sub Subject ID'),
            'name' => Yii::t('main', 'Name'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSubSubject()
    {
        return $this->hasOne(SubSubject::className(), ['id' => 'sub_subject_id']);
    }
}
