<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "categories".
 *
 * @property int     $id
 * @property string  $name Название категории
 * @property int     $pos  Положение в списке
 *
 * @property Item[] $items
 * @property Size[] $sizes
 */
class Category extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'categories';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['pos'], 'integer'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id'   => 'ID',
            'name' => 'Название категории',
            'pos'  => 'Положение в списке',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItems()
    {
        return $this->hasMany(Item::class, ['category_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSizes()
    {
        return $this->hasMany(Size::class, ['category_id' => 'id']);
    }
}
