<?php
/**
 * Created by PhpStorm.
 * User: Miinno-10
 * Date: 2017/8/29
 * Time: 14:49
 */

namespace backend\components;

use Yii;
use yii\base\ActionFilter;

class MyBehavior extends ActionFilter
{
    public function beforeAction($action)
    {
        var_dump(111);
        return true;
    }
    public function isGuest ()
    {
        return Yii::$app->user->isGuest;
    }
}