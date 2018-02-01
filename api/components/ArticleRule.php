<?php

namespace backend\components;
/**
 * Created by PhpStorm.
 * User: Miinno-10
 * Date: 2017/8/22
 * Time: 17:12
 */
use Yii;
use yii\rbac\Rule;

class ArticleRule extends Rule
{
    public $name = 'article';
    public function execute($user, $item, $params)
    {
        // 这里先设置为false,逻辑上后面再完善
        return false;
    }
}