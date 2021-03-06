<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "order_list".
 *
 * @property int $id
 * @property int|null $user_id
 * @property string $fullname
 * @property string $address
 * @property string $phone
 * @property string $email
 * @property int $status
 * @property int $created_at
 * @property int $created_by
 * @property int $updated_at
 * @property int $updated_by
 */
class OrderList extends \yii\db\ActiveRecord
{

    public $verifyCode;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'order_list';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'status', 'created_at', 'created_by', 'updated_at', 'updated_by'], 'integer'],
            [['fullname', 'address', 'phone', 'email', 'created_at', 'created_by', 'updated_at', 'updated_by'], 'required'],
            [['code', 'fullname', 'address', 'phone', 'email'], 'string', 'max' => 255],
            ['verifyCode', 'captcha'],
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
            'user_id' => 'User ID',
            'fullname' => 'Fullname',
            'address' => 'Address',
            'phone' => 'Phone',
            'email' => 'Email',
            'status' => 'Status',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
            'verifyCode' => 'Verification Code',
        ];
    }
}
