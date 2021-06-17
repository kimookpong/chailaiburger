<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%news_cat}}".
 *
 * @property int $id
 * @property string $name
 * @property int $detail
 */
class NewsCat extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%news_cat}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'detail'], 'required'],
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
            'name' => 'Name',
            'detail' => 'Detail',
        ];
    }

    /**
     * {@inheritdoc}
     * @return \common\models\query\NewsCatQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\NewsCatQuery(get_called_class());
    }
}
