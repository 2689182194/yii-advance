<?php

use yii\helpers\Html;
use yii\grid\GridView;
use kartik\export\ExportMenu;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\GoodsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Goods';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="goods-index">

    <div class="content">


        <?= ExportMenu::widget([
            'dataProvider' => $dataProvider,
            'columns' => [
                'id',
                'name',
                'created_at:datetime',
                'updated_at:datetime',
            ],
            'filename'=>'导出文件',
            'fontAwesome' => true,
            'showColumnSelector' => false,
            'dropdownOptions' => [
                'label' => '导出',
                'class' => 'btn btn-default'
            ],
            'exportConfig' => [
                ExportMenu::FORMAT_TEXT => false,
                ExportMenu::FORMAT_HTML => false,
                ExportMenu::FORMAT_CSV => false,
                ExportMenu::FORMAT_PDF => false
            ]
        ]); ?>
    </div>
    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Goods', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
//        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            'created_at:datetime',
            'updated_at:datetime',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
