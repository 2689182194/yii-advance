<?php
/**
 * Created by PhpStorm.
 * User: Miinno-10
 * Date: 2018/1/26
 * Time: 16:24
 */

namespace backend\models;

use Yii;
use yii\base\Exception;
use yii\base\Model;


/**
 * Created by PhpStorm.
 * Description: 阿里oss上传图片
 * Author: Weini
 * Date: 2016/11/17 0017
 * Time: 上午 11:34
 */
class UploadForm extends Model
{
    public $files;  //用来保存文件

    public function scenarios()
    {
        return [
            'upload' => ['files'], // 添加上传场景
        ];
    }

    public function rules()
    {
        return [
            [['files'], 'file', 'skipOnEmpty' => false, 'extensions' => 'jpg, png, gif,mp4', 'mimeTypes' => 'image/jpeg, image/png, image/gif', 'maxSize' => 1024 * 1024 * 10, 'maxFiles' => 1, 'on' => ['upload']],
            //设置图片的验证规则
        ];
    }

    /**
     * 上传单个文件到阿里云
     * @return boolean  上传是否成功
     */
    public function uploadfile()
    {
        $res['error'] = 1;

        if ($this->validate()) {
            $uploadPath = dirname(dirname(__FILE__)) . '/web/uploads/';  // 取得上传路径
            if (!file_exists($uploadPath)) {
                @mkdir($uploadPath, 0777, true);
            }

            $ext = $this->files->getExtension();                // 获取文件的扩展名
            $randnums = $this->getrandnums();                   // 生成一个随机数，为了重命名文件
            $imageName = date("YmdHis") . $randnums . '.' . $ext;     // 重命名文件
            $ossfile = 'file/' . date("Ymd") . '/' . $imageName;      // 这里是保存到阿里云oss的文件名和路径。如果只有文件名，就会放到空间的根目录下。
            $filePath = $uploadPath . $imageName;                 // 生成文件的绝对路径

            if ($this->files->saveAs($filePath)) {               // 上传文件到服务器
                $filedata['filename'] = $imageName;             // 准备图片信息，保存到数据库
                $filedata['filePath'] = $filePath;              // 准备图片信息，保存到数据库
                $filedata['ossfile'] = $ossfile;                // 准备图片信息，保存到数据库
                $filedata['userid'] = Yii::$app->user->id;      // 准备图片信息，保存到数据库，这个字段必须要，以免其他用户恶意删除别人的图片
                $filedata['uploadtime'] = time();               // 准备图片信息，保存到数据库

                // 上边这些代码不能照搬，要根据你项目的需求进行相应的修改。反正目的就是记录上传文件的信息
                // 老板，这些代码是我搬来的，没仔细看，如果出问题了，你就扣我的奖金吧^_^

                $trans = Yii::$app->db->beginTransaction();     // 开启事务
                try {
                    $savefile = Yii::$app->db->createCommand()->insert('file', $filedata)->execute(); //把文件的上传信息写入数据库
                    $newid = Yii::$app->db->getLastInsertID();  //获取新增文件的id，用于返回。

                    if ($savefile) {                            // 如果插入数据库成功
                        $ossupload = Yii::$app->Aliyunoss->upload($ossfile, $filePath);  //调用Aliyunoss组件里边的upload方法把文件上传到阿里云oss

                        if ($ossupload) {                       // 如果上传成功，
                            $res['error'] = 0;                  // 准备返回信息
                            $res['fileid'] = $newid;            // 准备返回信息
                            $res['ossfile'] = $ossfile;         // 准备返回信息
                            $trans->commit();                   // 提交事务
                        } else {                                // 如果上传失败
                            unlink($filePath);                  // 删除服务器上的文件
                            $trans->rollBack();                 // 事务回滚
                        }
                    }
                    unlink($filePath);                          // 插入数据库失败，删除服务器上的文件
                    $trans->rollBack();                         // 事务回滚
                } catch (Exception $e) {                         // 出了异常
                    unlink($filePath);                          // 删除服务器上的文件
                    $trans->rollBack();                         // 事务回滚
                }

            }
        }

        return $res;                                            // 返回上传信息
    }

    /**
     * 生成随机数
     * @return string 随机数
     */
    protected function getrandnums()
    {
        $arr = array();
        while (count($arr) < 10) {
            $arr[] = rand(1, 10);
            $arr = array_unique($arr);
        }
        return implode("", $arr);
    }
}