<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%product_cat}}".
 *
 * @property int $id
 * @property string $name
 * @property int $detail
 */
class ProductCat extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%product_cat}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'detail'], 'required'],
            [['detail'], 'integer'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'detail' => 'Detail',
        ];
    }

    /**
     * {@inheritdoc}
     * @return \common\models\query\ProductCatQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\ProductCatQuery(get_called_class());
    }
}