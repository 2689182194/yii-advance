<?php
/**
 * Created by PhpStorm.
 * User: Miinno-10
 * Date: 2018/1/19
 * Time: 13:37
 */

namespace backend\controllers;

use backend\models\UploadForm;
use GuzzleHttp\Psr7\UploadedFile;
use yii\web\Controller;
use Yii;

class CeshiController extends Controller
{
    public $enableCsrfValidation = false;

    public function actionCeshi()
    {
        $re = Yii::$app->Aliyunoss->test();
        var_dump($re);
        die;
//        if($_POST){
//            $bucket = Common::getBucketName();
//            var_dump($bucket);die;
////            $ossClient = Common::getOssClient();
////            if (is_null($ossClient)) exit(1);
////            var_dump($_FILES);die;
//        }
//        return $this->render('ceshi');
    }

    public function actionIndex()
    {
        $result = OSS::upload('小视屏', '/c/Users/Miinno-10/Desktop/图片/小视屏.mp4
'); // 上传一个文件
        var_dump($result);
        die;

        echo OSS::getUrl('某个文件的名称'); // 打印出某个文件的外网链接

        OSS::createBucket('一个字符串'); // 新增一个 Bucket。注意，Bucket 名称具有全局唯一性，也就是说跟其他人的 Bucket 名称也不能相同。

        OSS::getAllObjectKey('某个 Bucket 名称'); // 获取该 Bucket 中所有文件的文件名，返回 Array。
    }


//    public function actionCeshi1()
//    {
//
//        $accessKeyId = "L***F";
//        $accessKeySecret = "w****y";
//        $endpoint = "http://oss-cn-**.aliyuncs.com";
//        $bucket = " **-ceshi";
//        $object = " <您使用的Object名字，注意命名规范>";
//        $content = "Hi, OSS.";
//        try {
//            $ossClient = new OssClient($accessKeyId, $accessKeySecret, $endpoint);
//            $ossClient->putObject($bucket, $object, $content);
//        } catch (OssException $e) {
//            print $e->getMessage();
//        }
//    }

    public function actionTestAliyun()
    {

        $model = new UploadForm();  // 实例化上传类
        if (Yii::$app->request->isPost) {
            $model->files = \yii\web\UploadedFile::getInstance($model, 'files');  //使用UploadedFile的getInstance方法接收单个文件

            $model->setScenario('upload'); // 设置upload场景
            $res = $model->uploadfile();  //调用model里边的upload方法执行上传
            $err = $model->getErrors();  //获取错误信息

            echo "<pre>";
            print_r($res);  //打印上传结果
            print_r($err);  //打印错误信息，方便排错
            exit;

        }

        return $this->render('aliyunoss', ['model' => $model]);
    }

    public function actionAdd()
    {
        var_dump($_FILES['UploadForm']);die;
//        echo $_FILES['UploadForm']['name'];die;
        $img_banner = trim($_FILES['UploadForm']['name']['files']);
        $img_banner = explode('.', $img_banner);
        $imgs_banner = $img_banner[1];
        $img_banner = date('YmdHis') . mt_rand(100, 1000) . md5($img_banner[0]);
        //文件重命名
        $vend_banners = "./images/upload/" . $img_banner . '.' . $imgs_banner;
        $vend_banner = $img_banner . '.' . $imgs_banner;

        $uploadPath = dirname(dirname(__FILE__)) . '/web/images/upload/'; // 取得临时文件路径
        if (!file_exists($uploadPath)) {
            @mkdir($uploadPath, 0777, true);
        }
        $file_Path_vend_banner = $uploadPath . $vend_banner;
        echo $_FILES['UploadForm']['tmp_name']['files'];die;
        $filepath_vend_banner = str_replace("\\", "/", $file_Path_vend_banner);//绝对路径，上传第二个参数
        $object_vend_banner = "data/Company/" . $vend_banner;      //拼接存储路径和文件名称，上传第一个参数
        $vend_banner_url = Yii::$app->Aliyunoss->upload($object_vend_banner, $_FILES['UploadForm']['tmp_name']['files']);
        var_dump($vend_banner_url);die;
        if (is_uploaded_file($_FILES['UploadForm']['tmp_name']['files'])) { //判断是否post上传
            if (!move_uploaded_file($_FILES['UploadForm']['tmp_name']['files'], $vend_banners)) {
                //移动到临时目录里
                echo 'banner上传失败';
                exit();
            }
        }
        echo $object_vend_banner;
        echo "<br/>";
        echo $filepath_vend_banner;
        echo "<br/>";
        $vend_banner_url = Yii::$app->Aliyunoss->upload($object_vend_banner, $filepath_vend_banner);
        var_dump($vend_banner_url);die;
        //C:/wamp64/www/advanced/backend/web/images/upload/20180126165320696127affd939a81ffe30969f0d74a20c6d.jpg
        //C:\Users\Miinno-10\Desktop\图片

        $result = Yii::$app->Aliyunoss->upload($object_vend_banner, 'C:/Users/Miinno-10/Desktop/picture/server_img_02.jpg
'); // 上传一个文件
        var_dump($result);
        die;
        //调用新建的文件，执行OSS上传，返回的是上传到阿里云的OSS文件路径，打印出来是：
        //string(116) "http:// ******.oss-cn-******.aliyuncs.com/data/Company/20170908124236303cc17c30cd111c7215fc8f51f8790e0e1.jpg"

    }
}
