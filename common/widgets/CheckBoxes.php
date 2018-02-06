<?php
/**
 * Created by PhpStorm.
 * User: Davron
 * Date: 2018/02/06
 * Time: 23:12
 */

namespace common\widgets;

use yii\base\Widget;

class CheckBoxes extends Widget
{
    public $checkboxes;

    public function run()
    {
        return $this->render('checkboxes');
    }
}