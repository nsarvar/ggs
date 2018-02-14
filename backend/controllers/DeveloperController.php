<?php
/**
 * Created by PhpStorm.
 * User: Davron
 * Date: 2018/02/04
 * Time: 14:33
 */

namespace backend\controllers;

use backend\components\Controller;
use common\models\AuthAssignment;
use common\models\AuthItem;
use common\models\Subject;
use common\models\SubjectCategory;
use common\models\User;
use common\rules\AuthorRule;
use Yii;

class DeveloperController extends Controller
{
    public function actionAddRole() {
//        $role = Yii::$app->authManager->createRole('admin');
//        $role->description = 'Администратор';
//        Yii::$app->authManager->add($role);
//
//        $role = Yii::$app->authManager->createRole('author');
//        $role->description = 'Автор';
//        Yii::$app->authManager->add($role);
//
//        $role = Yii::$app->authManager->createRole('banned');
//        $role->description = 'Иплос';
//        Yii::$app->authManager->add($role);

        $this->dump("Finish");
    }

    public function actionCreatePermission() {

//        $rule = new AuthorRule();
//        $permit = Yii::$app->authManager->createPermission('updateOwnPost');
//        $permit->description = 'O\'zini Post ini update qilish imkoniyati';
//        $permit->ruleName = $rule->name;
//        Yii::$app->authManager->add($permit);

        $this->dump("Finish");
    }

    public function actionAddChild() {
//        $permit = Yii::$app->authManager->getPermission('updateOwnPost');
//        $role_author = Yii::$app->authManager->getRole('author');
//        $role = Yii::$app->authManager->getPermission('updatePost');
//        Yii::$app->authManager->addChild($permit, $role);
//        Yii::$app->authManager->addChild($role_author, $permit);

        $this->dump("Finish");
    }

    public function actionSetRole() {

//        $role = Yii::$app->authManager->getRole('author');
//        Yii::$app->authManager->assign($role, 3);

        $this->dump("Finish");
    }

    public function actionCreateRule() {
//        $auth = Yii::$app->authManager;
//        $rule = new AuthorRule();
//        $auth->add($rule);
        $this->dump("Finish");
    }

    public function actionTest() {
        $this->dump(Subject::getModelsToSelect());
    }

}