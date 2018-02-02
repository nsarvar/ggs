<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "account_log".
 *
 * @property int $id
 * @property int $user_id
 * @property string $login_time
 * @property string $device
 * @property string $event
 *
 * @property Account $user
 */
class AccountLog extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'account_log';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'login_time', 'device', 'event'], 'required'],
            [['user_id'], 'integer'],
            [['login_time'], 'safe'],
            [['device', 'event'], 'string', 'max' => 200],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => Account::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('main', 'ID'),
            'user_id' => Yii::t('main', 'User ID'),
            'login_time' => Yii::t('main', 'Login Time'),
            'device' => Yii::t('main', 'Device'),
            'event' => Yii::t('main', 'Event'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(Account::className(), ['id' => 'user_id']);
    }
}
