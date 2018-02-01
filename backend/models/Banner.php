<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%banner}}".
 *
 * @property int $id
 * @property int $goods_id 商品id
 * @property string $banner 图片
 */
class Banner extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%banner}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
//            [['goods_id'], 'integer'],
//            [['banner'], 'string', 'max' => 255],
//            [['banner'], 'image', 'extensions' => 'png, jpg',
////                'minWidth' => 64, 'maxWidth' => 1920,
////                'minHeight' => 64, 'maxHeight' => 1080,
////                'maxSize' => 800 * 1024,
//                'tooMany' => 10,
//                'enableClientValidation' => true,
//                'tooBig' => '上传文件不能大于{formattedLimit}'
//            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'goods_id' => 'Goods ID',
            'banner' => 'Banner',
        ];
    }
}
