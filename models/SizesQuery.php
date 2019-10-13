<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Size]].
 *
 * @see Size
 */
class SizesQuery extends \yii\db\ActiveQuery
{
    public function withCategory(int $categoryId)
    {
        return $this->where(['category_id' => $categoryId]);
    }
}
