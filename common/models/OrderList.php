<?php

namespace common\models;

use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "{{%order_list}}".
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
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%order_list}}';
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::class,
            BlameableBehavior::class,
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'status', 'created_at', 'created_by', 'updated_at', 'updated_by'], 'integer'],
            [['fullname', 'address', 'phone', 'email', 'created_at', 'created_by', 'updated_at', 'updated_by'], 'required'],
            [['fullname', 'address', 'phone', 'email'], 'string', 'max' => 255],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['created_by' => 'id']],
            [['updated_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['updated_by' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'fullname' => 'ชื่อ-นามสกุล',
            'address' => 'ที่อยู่',
            'phone' => 'เบอร์มือถือ',
            'email' => 'E-mail',
            'status' => 'Status',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
        ];
    }

    /**
     * {@inheritdoc}
     * @return \common\models\query\OrderListQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\OrderListQuery(get_called_class());
    }

    public function beforeSave($insert)
    {
        if ($this->isNewRecord) {
            $this->created_at = 111111;
            $this->updated_at = 111111;
            $this->created_by = Yii::$app->user->identity->id;
            $this->updated_by = Yii::$app->user->identity->id;
        } else {
            $this->updated_at = 111111;
            $this->updated_by = Yii::$app->user->identity->id;
        }

        if ($this->TITLE) {
            $this->VALUE = json_encode(
                array(
                    'var' => [
                        'title',
                        'detail'
                    ],
                    'value' => [
                        $this->TITLE,
                        $this->DETAIL
                    ],
                ),
                JSON_UNESCAPED_UNICODE
            );
        }

        return parent::beforeSave($insert);
    }
}
