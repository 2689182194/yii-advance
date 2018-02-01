<?php
return [
    'adminEmail' => 'admin@example.com',
/*    'oss' => array(
        'ossServer' => 'http://oss-cn-beijing.aliyuncs.com', //服务器外网地址，深圳为 http://oss-cn-shenzhen.aliyuncs.com
        'ossServerInternal' => 'http://oss-cn-beijing-internal.aliyuncs.com', //服务器内网地址，深圳为 http://oss-cn-shenzhen-internal.aliyuncs.com
        'AccessKeyId' => 'LTAI8tK5IO0txWzF', //阿里云给的AccessKeyId
        'AccessKeySecret' => 'wIkzucfVf3v39vSaEmOKubEeu3nEqy', //阿里云给的AccessKeySecret
        'Bucket' => 'video-data-all' //创建的空间名
    ),*/
    'oss' =>[
        'accessKeyId'=>'LTAI8tK5IO0txWzF',
        'accessKeySecret'=>'wIkzucfVf3v39vSaEmOKubEeu3nEqy',
        'bucket' => 'video-data-all',
        'endPoint' => 'oss-cn-beijing.aliyuncs.com',
    ]
];
