<?php
/**
 * Created by PhpStorm.
 * User: Miinno-10
 * Date: 2018/1/10
 * Time: 13:55
 */

namespace backend\models;
use Yii;
use yii\web\UploadedFile;
class Upload extends \yii\db\ActiveRecord
{
    /**
     * @var UploadedFile|Null file attribute
     */
    public $file;
    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [["file"], "file", 'maxFiles' => 10],
        ];
    }
}