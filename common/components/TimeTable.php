<?php
/**
 * Created by PhpStorm.
 * User: Davron
 * Date: 2018/02/06
 * Time: 23:06
 */

namespace common\components;


use Yii;

class TimeTable
{
    public function getWeekDays() {
        return [
            1 => Yii::t('main','Dushanba'),
            2 => Yii::t('main','Seshanba'),
            3 => Yii::t('main','Chorshanba'),
            4 => Yii::t('main','Payshanba'),
            5 => Yii::t('main','Juma'),
            6 => Yii::t('main','Shanba')];
    }

    public function getHours() {
        return [
            1 => '9:00-10:00',
            2 => '10:00-11:00',
            3 => '11:00-12:00',
            4 => '12:00-13:00',
            5 => '14:00-15:00',
            6 => '15:00-16:00',
            7 => '16:00-17:00',
            8 => '17:00-18:00',
        ];
    }

}