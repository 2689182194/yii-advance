<?php
/**
 * Created by PhpStorm.
 * User: Miinno-10
 * Date: 2017/8/22
 * Time: 18:32
 */

namespace backend\controllers;

use Yii;
use yii\web\Controller;

class RbacController extends Controller
{
    public function actionInit()
    {
        // 这个是我们上节课添加的authManager组件，组件的调用方式没忘吧？
        $auth = Yii::$app->authManager;
        // 添加 "/blog/index" 权限
        $blogIndex = $auth->createPermission('/blog/index');
        $blogIndex->description = '博客列表';
        $auth->add($blogIndex);//auth_item表中添加权限

        // 创建一个角色 '博客管理'，并为该角色分配"/blog/index"权限
        $blogManage = $auth->createRole('博客管理');
        $auth->add($blogManage);//auth_item表中添加角色

        $auth->addChild($blogManage, $blogIndex);//auth_item_child 添加角色和权限的关系

        // 为用户 test1（该用户的uid=1） 分配角色 "博客管理" 权限
        $auth->assign($blogManage, 1); // 1是test1用户的uid   //auth_assignment 添加用户和角色的关联关系
    }

    // 添加权限
    public function actionInit2 ()
    {
        $auth = Yii::$app->authManager;

        // 添加权限, 注意斜杠不要反了
        $blogView = $auth->createPermission('/blog/view');
        $auth->add($blogView);
        $blogCreate = $auth->createPermission('/blog/create');
        $auth->add($blogCreate);
        $blogUpdate = $auth->createPermission('/blog/update');
        $auth->add($blogUpdate);
        $blogDelete = $auth->createPermission('/blog/delete');
        $auth->add($blogDelete);

        // 分配给我们已经添加过的"博客管理"权限
        $blogManage = $auth->getRole('博客管理');
        $auth->addChild($blogManage, $blogView);
        $auth->addChild($blogManage, $blogCreate);
        $auth->addChild($blogManage, $blogUpdate);
        $auth->addChild($blogManage, $blogDelete);
    }
}