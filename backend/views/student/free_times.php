<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 08.02.18
 * Time: 9:34
 */

?>

<div>
   <h2 class="text-center"><?=Yii::t('main','Bo\'sh vaqtlarni belgilash')?></h2>
   <?=$this->render('_schedule_form',['weekdays' => $weekdays, 'hours' => $hours, 'parent' => $parent, 'type' => $type, 'times' => $times])?>
</div>
