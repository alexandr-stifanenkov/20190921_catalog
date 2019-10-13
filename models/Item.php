<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "items".
 *
 * @property int        $id
 * @property string     $image         Изображение
 * @property string     $name          Название товара
 * @property string     $description   Описание товара
 * @property double     $price         Цена
 * @property int        $category_id   Категория
 * @property int        $collection_id Коллекция
 * @property string     $created_at    Добавлено в каталог
 *
 * @property Category   $category
 * @property Collection $collection
 * @property Size[]     $sizes
 */
class Item extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'items';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['description'], 'string'],
            [['price', 'category_id', 'collection_id'], 'required'],
            [['price'], 'number'],
            [['category_id', 'collection_id'], 'integer'],
            [['created_at'], 'safe'],
            [['image', 'name'], 'string', 'max' => 255],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Categories::className(), 'targetAttribute' => ['category_id' => 'id']],
            [['collection_id'], 'exist', 'skipOnError' => true, 'targetClass' => Collections::className(), 'targetAttribute' => ['collection_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id'            => 'ID',
            'image'         => 'Изображение',
            'name'          => 'Название товара',
            'description'   => 'Описание товара',
            'price'         => 'Цена',
            'category_id'   => 'Категория',
            'collection_id' => 'Коллекция',
            'created_at'    => 'Добавлено в каталог',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::class, ['id' => 'category_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCollection()
    {
        return $this->hasOne(Collection::class, ['id' => 'collection_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSizes()
    {
        return $this->hasMany(Size::class, ['id' => 'size_id'])
            ->viaTable('items_sizes', ['item_id' => 'id'])
            ->asArray();
    }

    /**
     * {@inheritdoc}
     * @return ItemsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ItemsQuery(get_called_class());
    }
}
