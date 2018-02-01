<?php
/**
 * Created by PhpStorm.
 * User: Miinno-10
 * Date: 2018/1/10
 * Time: 13:57
 */
use yii\widgets\ActiveForm;

$form = ActiveForm::begin(["options" => ["enctype" => "multipart/form-data"]]);
?>
<?= $form->field($model, 'file[]')->fileInput(['multiple' => true]) ?>

    <button>Submit</button>

<?php ActiveForm::end(); ?>