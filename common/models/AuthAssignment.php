<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "auth_assignment".
 *
 * @property string $item_name
 * @property int $user_id
 * @property int $created_at
 *
 * @property User $user
 * @property AuthItem $itemName
 */
class AuthAssignment extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'auth_assignment';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['item_name', 'user_id'], 'required'],
            [['user_id', 'created_at'], 'integer'],
            [['item_name'], 'string', 'max' => 64],
            [['item_name', 'user_id'], 'unique', 'targetAttribute' => ['item_name', 'user_id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
            [['item_name'], 'exist', 'skipOnError' => true, 'targetClass' => AuthItem::className(), 'targetAttribute' => ['item_name' => 'name']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'item_name' => Yii::t('main', 'Item Name'),
            'user_id' => Yii::t('main', 'User ID'),
            'created_at' => Yii::t('main', 'Created At'),
            'createdAt' => Yii::t('main', 'Created At'),
            'username' => Yii::t('main', 'AA Username'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    public function getUsername() {
        $user = User::findOne($this->user_id);
        return empty($user) ? false : $user->username;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItemName()
    {
        return $this->hasOne(AuthItem::className(), ['name' => 'item_name']);
    }

    public function getCreatedAt() {
        return date('Y-m-d H:i',$this->created_at);
    }

    public function getAllUserIds() {
        $models = AuthAssignment::find()->select('user_id')->where(['item_name' => $this->item_name])->asArray()->all();
        return $models;
    }

    public function getAllNotUsers() {
        $models = User::find()->filterWhere(['NOT IN', 'id', $this->allNotUsers]);
        return $models;
    }
}
