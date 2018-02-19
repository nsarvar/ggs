<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "notice".
 *
 * @property int $id
 * @property string $title
 * @property string $body
 * @property int $created_by
 * @property string $created_at
 *
 * @property User $createdBy
 */
class Notice extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'notice';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'body', 'created_by', 'created_at'], 'required'],
            [['body'], 'string'],
            [['created_by'], 'integer'],
            [['created_at'], 'safe'],
            [['title'], 'string', 'max' => 500],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['created_by' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('main', 'ID'),
            'title' => Yii::t('main', 'Title'),
            'body' => Yii::t('main', 'Body'),
            'created_by' => Yii::t('main', 'Created By'),
            'created_at' => Yii::t('main', 'Created At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCreatedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'created_by']);
    }
}
