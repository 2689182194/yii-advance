<?php
/**
 * Created by PhpStorm.
 * User: Miinno-10
 * Date: 2018/1/19
 * Time: 13:38
 */

namespace backend\components;
use Yii;
use chonder\AliyunOSS\AliyunOSS;

class OSS {

    private $ossClient;

    public function __construct($isInternal = false)
    {
        $serverAddress = $isInternal ? Yii::$app->params['oss']['ossServerInternal'] : Yii::$app->params['oss']['ossServer'];
        $this->ossClient = AliyunOSS::boot(
            $serverAddress,
            Yii::$app->params['oss']['AccessKeyId'],
            Yii::$app->params['oss']['AccessKeySecret']
        );
    }

    public static function upload($ossKey, $filePath)
    {
        //$oss = new OSS(true); // 上传文件使用内网，免流量费
        $oss = new OSS(true);
        $oss->ossClient->setBucket(Yii::$app->params['oss']['Bucket']);
        $oss->ossClient->uploadFile($ossKey, $filePath);
    }

    public static function getUrl($ossKey)
    {
        $oss = new OSS();
        $oss->ossClient->setBucket(Yii::$app->params['oss']['Bucket']);
        return preg_replace('/(.*)\?OSSAccessKeyId=.*/', '$1', $oss->ossClient->getUrl($ossKey, new \DateTime("+1 day")));
    }

    public static function delFile($ossKey)
    {
        $oss = new OSS();
        $oss->ossClient->setBucket(Yii::$app->params['oss']['Bucket']);
        $oss->ossClient->delFile($ossKey);
    }

    public static function createBucket($bucketName)
    {
        $oss = new OSS();
        return $oss->ossClient->createBucket($bucketName);
    }

    public static function getAllObjectKey($bucketName)
    {
        $oss = new OSS();
        return $oss->ossClient->getAllObjectKey($bucketName);
    }

}