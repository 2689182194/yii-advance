<?php
/**
 * Created by PhpStorm.
 * User: Miinno-10
 * Date: 2018/1/10
 * Time: 13:55
 */

namespace backend\controllers;

use backend\models\Upload;
use yii\web\UploadedFile;
use Yii;

class ToolsController extends \yii\web\Controller
{
    /**
     *    文件上传
     *  我们这里上传成功后把图片的地址进行返回
     */
    /*    public function actionUpload()
        {
            $model = new Upload();
            $uploadSuccessPath = "";
            if (Yii::$app->request->isPost) {
                $model->load(Yii::$app->request->post(),'');
                $model->file = UploadedFile::getInstance($model, "file");
                //文件上传存放的目录
                $dir = Yii::getAlias('@webroot/assets', true) . '/public/uploads/' . date("Ymd") . '/';
                if (!is_dir($dir))
                    mkdir($dir, 7777, true);
                if ($model->validate()) {
                    //文件名
                    $fileName = date("HiiHsHis") . "." . $model->file->extension;
                    $dir = $dir . "/" . $fileName;
                    $model->file->saveAs($dir);
                    $uploadSuccessPath = "/uploads/" . date("Ymd") . "/" . $fileName;
                    return $name = isset($fileName) ? Yii::getAlias('@web/assets', true) . '/public/uploads/' . date("Ymd") . '/' . $fileName : '';
                }
            }

            return $this->render("upload", [
                "model" => $model,
                "uploadSuccessPath" => isset($fileName) ? Yii::getAlias('@web/assets', true) . '/public/uploads/' . date("Ymd") . '/' . $fileName : '',
            ]);
        }*/


    public function actionUpload()
    {
        $model = new Upload();

        if (Yii::$app->request->isPost) {
            $model->file = UploadedFile::getInstances($model, 'file');
//            echo "<pre>";
//            print_r($model->file);
//            echo "</pre>";die;
            $dir = Yii::getAlias('@webroot/assets', true) . '/public/uploads/' . date("Ymd").'/' ;
            if (!is_dir($dir))
                mkdir($dir, 7777, true);
            if ($model->file && $model->validate()) {

                foreach ($model->file as $file) {

                    $re = $file->saveAs($dir . date("HiiHsHis") . "." . $file->extension);
                }
            }
            $ces[]= $re;
                        echo "<pre>";
            print_r($ces);
            echo "</pre>";die;

        }

        return $this->render('upload', ['model' => $model]);
    }

}