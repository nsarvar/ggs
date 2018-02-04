<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 02.02.18
 * Time: 12:12
 */

namespace common\components;


use Yii;

class Controller extends \yii\web\Controller
{
    public function referrer()
    {
        if(isset(Yii::$app->request->referrer) && !empty(Yii::$app->request->referrer))
            return $this->redirect(Yii::$app->request->referrer);
        else
            return $this->goHome();
    }

    public function dump($obj) {
        echo '<pre>';
        print_r($obj);
        echo '</pre>';
        exit;
    }

    public function init() {
        $session = Yii::$app->session;
        if ($session->has('lang')) {
            Yii::$app->language = $session->get('lang');
        } else {
            $lang = Yii::$app->params['main_language'];
            Yii::$app->language = $lang;
            $session->set('lang', $lang);
        }
    }

    public function actionLang($lang) {
        Yii::$app->language = $lang;
        Yii::$app->session->set('lang', $lang);
        return $this->referrer();
    }

}