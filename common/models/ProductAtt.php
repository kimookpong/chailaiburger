<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%product_att}}".
 *
 * @property int $id
 * @property int $code
 * @property string $name
 * @property string $detail
 * @property string $path
 */
class ProductAtt extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%product_att}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['code', 'name', 'detail', 'path'], 'required'],
            [['code'], 'integer'],
            [['name', 'detail'], 'string', 'max' => 255],
            [['path'], 'string', 'max' => 511],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'code' => 'Code',
            'name' => 'Name',
            'detail' => 'Detail',
            'path' => 'Path',
        ];
    }

    /**
     * {@inheritdoc}
     * @return \common\models\query\ProductAttQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\ProductAttQuery(get_called_class());
    }
}
