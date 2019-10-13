<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "menu".
 *
 * @property int $id
 * @property int $type Тип меню: 0 - верхнее, 1 - нижнее
 * @property string $name Название пункта меню
 * @property int $collection_id К какой коллекции относится
 * @property int $pos Положение в списке
 *
 * @property Collection $collection
 */
class Menu extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'menu';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['type', 'collection_id', 'pos'], 'integer'],
            [['name'], 'string', 'max' => 32],
            [['collection_id'], 'exist', 'skipOnError' => true, 'targetClass' => Collection::class, 'targetAttribute' => ['collection_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'type' => 'Тип меню: 0 - верхнее, 1 - нижнее',
            'name' => 'Название пункта меню',
            'collection_id' => 'К какой коллекции относится',
            'pos' => 'Положение в списке',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCollection()
    {
        return $this->hasOne(Collection::class, ['id' => 'collection_id']);
    }

    /**
     * {@inheritdoc}
     * @return MenuQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new MenuQuery(get_called_class());
    }
}
