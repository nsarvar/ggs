<?php
/**
 * Created by PhpStorm.
 * User: Davron
 * Date: 2018/02/04
 * Time: 18:45
 */

namespace common\rules;

use yii\rbac\Rule;

class AuthorRule extends Rule
{

    public $name = 'isAuthor';

    public function execute($user, $item, $params)
    {
        if(isset($params['author_id']) && $params['author_id'] == $user)
            return true;
        return false;
    }
}