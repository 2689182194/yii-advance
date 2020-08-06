<?php
use yii\helpers\Url;
/**
 * Created by PhpStorm.
 * User: Miinno-10
 * Date: 2018/1/26
 * Time: 14:59
 */
?>

<table width="620" align="center" border="0" cellpadding="1" cellspacing="1" style="background:#FB7"> <tr> <td width="464" height="27" bgcolor="#FFE7CE"> 代码如下</td> <td width="109" align="center" bgcolor="#FFE7CE" style="cursor:pointer;" onclick="doCopy('copy9020')">复制代码</td> </tr> <tr> <td height="auto" colspan="2" valign="top" bgcolor="#FFFFFF" style="padding:10px;" class="copyclass" id=copy9020>
            <?php
            $access_id = 'L***F';
            $access_key = 'w***qy';
            $url='http://oss-cn-beijing.aliyuncs.com';//更改成你自己的地址
            $policy = '{"expiration": "2120-01-01T12:00:00.000Z","conditions":[{"bucket": "ioutsider" },["content-length-range", 0, 104857600]]}';
            $policy = base64_encode($policy);
            $signature = base64_encode(hash_hmac('sha1', $policy, $access_key, true));//生成认证签名
            ?>
            <!DOCTYPE html>
            <html>
            <head>
                <title></title>
                <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
            </head>
            <body>
            <div>文件上传</div>
            <form action="<?php echo Url::to(['ceshi/ceshi']);?>" method="post" enctype="multipart/form-data">
                <label for="file">选择文件:</label>
                <input type="hidden" name="OSSAccessKeyId" id="OSSAccessKeyId"  value="<?php echo $access_id; ?>" />
                <input type="hidden" name="policy" id="policy"  value='<?php echo $policy; ?>' />
                <input type="hidden" name="signature" id="signature"  value="<?php echo $signature; ?>" />
                <input type="hidden" name="key" id="key"  value="${filename}" />
                <input type="file" name="file" id="file" />
                <br />
                <input type="submit" name="submit" value="确定" />
            </form>
            </body>
            </html></td></tr></table>
