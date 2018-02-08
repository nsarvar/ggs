<?php
/**
 * Created by PhpStorm.
 * User: Davron
 * Date: 2018/02/06
 * Time: 23:52
 */

use common\models\Times;
use kartik\checkbox\CheckboxX;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>

<div class="tab-form">
    <h3 class="text-center"><?=Yii::t('main','Xafta kunlari bo\'yicha')?></h3>
    <?php $form = ActiveForm::begin() ?>
    <ul class="nav nav-tabs">
        <?php $first = true; foreach ($weekdays as $key => $weekday) { ?>
            <li <?=$first ? 'class="active"' : ''?>><a href="#tab-<?=$key?>" data-toggle="tab"><?=$weekday?></a></li>
        <?php $first = false;} ?>
    </ul>
    <div class="tab-content">
        <?php $first = true; foreach ($weekdays as $key => $weekday) { ?>
            <div id="tab-<?=$key?>" class="tab-pane<?=$first ? ' active' : ''?>">
                <h3><?=Yii::t('main','{weekday} kungi bo\'sh vaqtlar.',['weekday' => $weekday] )?></h3>
                <?php foreach ($hours  as $key2 => $hour) {
                    $name = 'time-'.$key.'-'.$key2;
                    ?>
                    <div class="form-group has-success">
                        <label class="cbx-label" for="<?=$name?>">
                            <?php
                            echo CheckboxX::widget([
                                'name' => $name,
                                'options' => ['id' => $name],
                                'value' =>Times::hasTime($times,$key,$key2),
                                'pluginOptions'=>['threeState'=>false]
                            ]);
                            echo $hour;
                            ?>
                        </label>
                    </div>
                <?php } ?>
            </div>
        <?php $first = false; } ?>
    </div>
    <br>
    <div class="form-group">
        <?= Html::submitButton(Yii::t('main', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>
    <?php ActiveForm::end() ?>
</div>
