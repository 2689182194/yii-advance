<?php
use yii\helpers\Url;
use mdm\admin\components\MenuHelper;

?>
<aside class="main-sidebar">

    <section class="sidebar">
        <?php
        $callback = function($menu){
            return [
                'label' => $menu['name'],
                'url' => [$menu['route']],
                'icon' => $menu['data'],
                'items' => $menu['children']
            ];
        };
        $items = MenuHelper::getAssignedMenu(Yii::$app->user->id, null, $callback, true);
        echo dmstr\widgets\Menu::widget([
            'options' => ['class' => 'sidebar-menu'],
            'items' => $items
        ]);
        ?>
    </section>
</aside>
