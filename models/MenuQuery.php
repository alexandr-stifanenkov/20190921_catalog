<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Menu]].
 *
 * @see Menu
 */
class MenuQuery extends \yii\db\ActiveQuery
{
    public function headerMenu()
    {
        return $this
            ->where(['type' => 0])
            ->orderBy('pos')
            ->asArray()
            ->all();
    }

    public function footerMenu()
    {
        return $this
            ->where(['type' => 1])
            ->orderBy('pos')
            ->asArray()
            ->all();
    }
}
