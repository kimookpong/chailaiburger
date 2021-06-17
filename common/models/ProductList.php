<?php

namespace common\models;

use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\helpers\FileHelper;
use common\models\ProductCat;

/**
 * This is the model class for table "{{%product_list}}".
 *
 * @property int $id
 * @property string $code
 * @property int $cid
 * @property string $name
 * @property string $detail
 * @property string $imagePath
 * @property int $created_at
 * @property int $created_by
 * @property int $updated_at
 * @property int $updated_by
 * 
 * @property User $createdBy
 * @property User $updatedBy
 */
class ProductList extends \yii\db\ActiveRecord
{
    /**
     * @var \yii\web\UploadedFile
     */
    public $imagePath;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%product_list}}';
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
            [['cid', 'name', 'detail'], 'required'],
            [['cid', 'price', 'discount', 'created_at', 'created_by', 'updated_at', 'updated_by'], 'integer'],
            [['detail'], 'string'],
            [['imagePath'], 'image', 'extensions' => 'png, jpg, jpeg', 'maxSize' => 5 * 1024 * 1024],
            [['code', 'name', 'images'], 'string', 'max' => 255],
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
            'code' => 'Code',
            'cid' => 'Cid',
            'name' => 'Name',
            'detail' => 'Detail',
            'price' => 'Price',
            'discount' => 'Discount',
            'created_at' => 'Created At',
            'created_by' => 'Created User',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated User',
        ];
    }

    /**
     * {@inheritdoc}
     * @return \common\models\query\ProductListQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\ProductListQuery(get_called_class());
    }

    /**
     * Gets query for [[CreatedBy]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\UserQuery
     */
    public function getCreatedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'created_by']);
    }

    /**
     * Gets query for [[UpdatedBy]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\UserQuery
     */
    public function getUpdatedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'updated_by']);
    }

    public function save($runValidation = true, $attributeNames = null)
    {

        if ($this->imagePath) {
            $this->images = '/products/' . Yii::$app->security->generateRandomString(8) . '.jpg';
        }
        $transaction = Yii::$app->db->beginTransaction();
        $ok = parent::save($runValidation, $attributeNames);
        if ($ok && $this->imagePath) {
            $fullPath = Yii::getAlias('@frontend/web/storage' . $this->images);
            $create_doc = FileHelper::createDirectory(dirname($fullPath));
            $saveAs = $this->imagePath->saveAs($fullPath);
            if (!$create_doc && !$saveAs) {
                $transaction->rollback();
                return false;
            }
        }
        $transaction->commit();
        return $ok;
    }

    public function getImageUrl()
    {
        if ($this->images) {
            return Yii::$app->params['frontendUrl'] . '/storage' . $this->images;
        }
        return Yii::$app->params['frontendUrl'] . '/img/no_image.svg';
    }

    public function getCatagory()
    {
        return $this->hasOne(ProductCat::className(), ['id' => 'cid']);
    }

    public function getCatagoryList()
    {
        return ProductCat::find()->all();
    }

    public function afterDelete()
    {
        parent::afterDelete();
        $videoPath = Yii::getAlias('@frontend/web/storage/videos/' . $this->video_id . '.mp4');
        unlink($videoPath);

        $thumnailPath = Yii::getAlias('@frontend/web/storage/thumbs/' . $this->video_id . '.jpg');

        if (file_exists($thumnailPath)) {
            unlink($thumnailPath);
        }
    }
}
