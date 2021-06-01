<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%content_list}}".
 *
 * @property int $id
 * @property int $code
 * @property int $cid
 * @property string $name
 * @property string $detail
 * @property int $created_at
 * @property int $created_user
 * @property int $updated_at
 * @property int $updated_user
 */
class ContentList extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%content_list}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['code', 'cid', 'name', 'detail', 'created_at', 'created_user', 'updated_at', 'updated_user'], 'required'],
            [['code', 'cid', 'created_at', 'created_user', 'updated_at', 'updated_user'], 'integer'],
            [['detail'], 'string'],
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
            'code' => 'Code',
            'cid' => 'Cid',
            'name' => 'Name',
            'detail' => 'Detail',
            'created_at' => 'Created At',
            'created_user' => 'Created User',
            'updated_at' => 'Updated At',
            'updated_user' => 'Updated User',
        ];
    }

    /**
     * {@inheritdoc}
     * @return \common\models\query\ContentListQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\ContentListQuery(get_called_class());
    }
}
