<?php
return [
    'adminEmail' => 'admin@example.com',
/*    'oss' => array(
        'ossServer' => 'http://oss-cn-beijing.aliyuncs.com', //服务器外网地址，深圳为 http://oss-cn-shenzhen.aliyuncs.com
        'ossServerInternal' => 'http://oss-cn-beijing-internal.aliyuncs.com', //服务器内网地址，深圳为 http://oss-cn-shenzhen-internal.aliyuncs.com
        'AccessKeyId' => '***', //阿里云给的AccessKeyId
        'AccessKeySecret' => '***', //阿里云给的AccessKeySecret
        'Bucket' => 'video-data-all' //创建的空间名
    ),*/
    'oss' =>[
        'accessKeyId'=>'***',
        'accessKeySecret'=>'***',
        'bucket' => 'video-data-all',
        'endPoint' => 'oss-cn-beijing.aliyuncs.com',
    ]
];
