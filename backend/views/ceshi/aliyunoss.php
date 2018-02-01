<?php
/**
 * Created by PhpStorm.
 * User: Miinno-10
 * Date: 2018/1/26
 * Time: 16:22
 */
use yii\widgets\ActiveForm;
use yii\helpers\Url;

?>

<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data'], 'action' => Url::to(['ceshi/add'])]) ?>

<?= $form->field($model, 'files')->fileInput() ?>

    <button>Submit</button>

<?php ActiveForm::end() ?>