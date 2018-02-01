<?php
/**
 * Created by PhpStorm.
 * User: Miinno-10
 * Date: 2018/1/10
 * Time: 13:32
 */

namespace backend\controllers;


use backend\components\OSS;
use backend\models\Banner;
use backend\models\Upload;
use yii\web\UploadedFile;
use yii\web\Controller;
use yii\helpers\Url;
use Yii;

class BannerController extends Controller
{
    public function actionIndex()
    {
        echo 222;
        die;
    }

    /**
     *    文件上传
     *  我们这里上传成功后把图片的地址进行返回
     */
    public function actionUpload()
    {
        $model = new Upload();
        $uploadSuccessPath = "";
        if (Yii::$app->request->isPost) {
            $model->load(Yii::$app->request->post(), '');
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
    }

    public $enableCsrfValidation = false;

    public function actionCreate($id = 1)
    {

        $model = new Banner();
        $relationBanners = Banner::find()->where(['goods_id' => $id])->asArray()->all();
        print_r(Yii::$app->request->post());
        if(Yii::$app->request->post())
        {
            $res = UploadedFile::getInstances($model, "banner");
            var_dump($res);die;
            $model->banner = UploadedFile::getInstances($model, "banner");
            //文件上传存放的目录
            $dir = Yii::getAlias('@webroot/assets', true) . '/public/uploads/' . date("Ymd") . '/';
            if (!is_dir($dir))
                mkdir($dir, 7777, true);
            if ($model->validate()) {
                foreach ($model->banner as $banner) {
                    //文件名
                    $fileName = date("HiiHsHis") . "." . $banner->extension;
                    $re = $banner->saveAs($dir . date("HiiHsHis") . "." . $banner->extension);
                    $ce[] = $re;
                }
                print_r($ce);die;
            }
        }
// @param $p1 Array 需要预览的商品图，是商品图的一个集合
// @param $p2 Array 对应商品图的操作属性，我们这里包括商品图删除的地址和商品图的id
        $p1 = $p2 = [];
        if ($relationBanners) {
            foreach ($relationBanners as $k => $v) {
                $p1[$k] = Yii::getAlias('@web/assets', true) . '/public/uploads/' . date("Ymd") . '/' . $v['banner'];
                $p2[$k] = [
                    // 要删除商品图的地址
                    'url' => Url::toRoute('/banner/delete'),
                    // 商品图对应的商品图id
                    'key' => $v['id'],
                ];
            }
        }

        return $this->render('create', [
            'p1' => $p1,
            'p2' => $p2,
            // 商品id
            'id' => $id,
            'model' => $model
        ]);

    }

    /**
     *    文件上传
     *  我们这里上传成功后把图片的地址进行返回
     */
    public static function Upload()
    {
        $model = new Banner();
        $uploadSuccessPath = "";
//        if (Yii::$app->request->isPost) {
        $model->banner = UploadedFile::getInstance($model, "banner");
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
        }
        return Yii::getAlias('@web/assets', true) . '/public/uploads/' . date("Ymd") . '/' . $fileName;
    }

//    }
    public function actionAsyncBanner()
    {
        // 保存商品banner图信息
        $model = new Banner;

        // 商品ID
        $id = Yii::$app->request->post('goods_id');

        // $p1 $p2是我们处理完图片之后需要返回的信息，其参数意义可参考上面的讲解
        $p1 = $p2 = [];


//        // 如果没有商品图或者商品id非真，返回空
//        if (empty($_FILES['Banner']['name']) || empty($_FILES['Banner']['name']['banner']) || !$id) {
//            echo '{}';
//            return;
//        }
//        $result = OSS::upload($_FILES['Banner']['name']['banner'], $_FILES['Banner']['tmp_name']['banner']); // 上传一个文件
//        var_dump($result);die;
        // 循环多张商品banner图进行上传和上传后的处理
        for ($i = 0; $i < count($_FILES['Banner']['name']['banner']); $i++) {

            // 上传之后的商品图是可以进行删除操作的，我们为每一个商品成功的商品图指定删除操作的地址
            $url = Url::toRoute(['banner/delete']);
            // 调用图片接口上传后返回的图片地址，注意是可访问到的图片地址哦
            //$res = UploadedFile::getInstances($model, "banner");
            //$model->load(Yii::$app->request->post(),'');
            $model->banner = UploadedFile::getInstances($model, "banner");
            //文件上传存放的目录
            $dir = Yii::getAlias('@webroot/assets', true) . '/public/uploads/' . date("Ymd") . '/';
            if (!is_dir($dir))
                mkdir($dir, 7777, true);
            if ($model->validate()) {
                foreach ($model->banner as $banner) {
                    //文件名
                    $fileName = date("HiiHsHis") . "." . $banner->extension;
                    $re = $banner->saveAs($dir . date("HiiHsHis") . "." . $banner->extension);
                    $ce[] = $re;
                }

            }
            $imageUrl = $fileName;


            $model->goods_id = $id;
            $model->banner = $imageUrl;
            $key = 0;
//            var_dump($model);die;
            if ($model->save(false)) {
                $key = $model->id;
            }

            // 这是一些额外的其他信息，如果你需要的话
            // $pathinfo = pathinfo($imageUrl);
            // $caption = $pathinfo['basename'];
            // $size = $_FILES['Banner']['size']['banner_url'][$i];


            $p1[$i] = Yii::getAlias('@web/assets', true) . '/public/uploads/' . date("Ymd") . '/' . $imageUrl;
            $p2[$i] = ['url' => $url, 'key' => $key];
        }


        // 返回上传成功后的商品图信息
        echo json_encode([
            'initialPreview' => $p1,
            'initialPreviewConfig' => $p2,
            'append' => true,
        ]);
        return;
    }

    public function actionDelete()
    {
        // 前面我们已经为成功上传的banner图指定了key,此处的key也即时banner图的id
        if ($id = Yii::$app->request->post('key')) {
            $model = Banner::findOne($id);
            $model->delete();
        }
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        return ['success' => true];
    }

    public function actionCeshi()
    {
        if($_POST){
            var_dump($_FILES);die;
        }
        return $this->render('ceshi');
    }
}