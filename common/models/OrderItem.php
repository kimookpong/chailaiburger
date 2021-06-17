<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%order_item}}".
 *
 * @property int $id
 * @property int $code
 * @property int $product_id
 * @property string $product_name
 * @property int $price
 * @property int $quantity
 * @property string $comment
 */
class OrderItem extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%order_item}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'code', 'product_id', 'product_name', 'price', 'quantity', 'comment'], 'required'],
            [['id', 'code', 'product_id', 'price', 'quantity'], 'integer'],
            [['product_name', 'comment'], 'string', 'max' => 255],
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
            'product_id' => 'Product ID',
            'product_name' => 'Product Name',
            'price' => 'Price',
            'quantity' => 'Quantity',
            'comment' => 'Comment',
        ];
    }

    /**
     * {@inheritdoc}
     * @return \common\models\query\OrderItemQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\OrderItemQuery(get_called_class());
    }
}
