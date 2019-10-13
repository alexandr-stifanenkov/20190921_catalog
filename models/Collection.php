<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "collections".
 *
 * @property int    $id
 * @property string $name Название коллекции
 * @property int    $pos  Положение в списке
 *
 * @property Item[] $items
 * @property Menu[] $menus
 */
class Collection extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'collections';
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
            'name' => 'Название коллекции',
            'pos'  => 'Положение в списке',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItems()
    {
        return $this->hasMany(Item::class, ['collection_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMenus()
    {
        return $this->hasMany(Menu::class, ['collection_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return CollectionsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CollectionsQuery(get_called_class());
    }
}
