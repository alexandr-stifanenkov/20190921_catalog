<?php

namespace app\models;

use yii\db\Query;

/**
 * This is the ActiveQuery class for [[Item]].
 *
 * @see Item
 */
class ItemsQuery extends \yii\db\ActiveQuery
{
    public function bySize($sizeId)
    {
        $subquery = (new \yii\db\Query())
            ->select('item_id')
            ->from('items_sizes')
            ->where(['size_id' => $sizeId]);

        return $this
            ->andWhere(['id' => $subquery]);
    }
}
