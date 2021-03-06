<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "order_item".
 *
 * @property int $id
 * @property string $code
 * @property int $product_id
 * @property string $product_name
 * @property int $price
 * @property int $quantity
 * @property string|null $comment
 */
class OrderItem extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'order_item';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['code', 'product_id', 'product_name', 'price', 'quantity'], 'required'],
            [['product_id', 'price', 'quantity'], 'integer'],
            [['code', 'product_name', 'comment'], 'string', 'max' => 255],
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
}
