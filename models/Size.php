<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "sizes".
 *
 * @property int      $id
 * @property string   $name        Название размера
 * @property int      $category_id К какой категории относится
 * @property int      $pos         Положение в списке
 *
 * @property Item[]   $items
 * @property Category $category
 */
class Size extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'sizes';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['category_id'], 'required'],
            [['category_id', 'pos'], 'integer'],
            [['name'], 'string', 'max' => 32],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['category_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id'          => 'ID',
            'name'        => 'Название размера',
            'category_id' => 'К какой категории относится',
            'pos'         => 'Положение в списке',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItems()
    {
        return $this->hasMany(Item::class, ['id' => 'item_id'])
            ->viaTable('items_sizes', ['size_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::class, ['id' => 'category_id']);
    }

    /**
     * {@inheritdoc}
     * @return SizesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new SizesQuery(get_called_class());
    }
}
