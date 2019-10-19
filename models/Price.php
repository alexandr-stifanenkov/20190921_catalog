<?php

namespace app\models;

use Yii;

/**
 * This is the model class for prices.
 */
class Price
{
    public const PRICE_DATA = [
        10 => [
            'id' => 10,
            'from' => 0,
            'till' => 1000,
            'name' => '0-1000 руб',
        ],
        20 => [
            'id' => 20,
            'from' => 1000,
            'till' => 3000,
            'name' => '1000-3000 руб',
        ],
        30 => [
            'id' => 30,
            'from' => 3000,
            'till' => 6000,
            'name' => '3000-6000 руб',
        ],
        40 => [
            'id' => 40,
            'from' => 6000,
            'till' => 20000,
            'name' => '6000-20000 руб',
        ],
    ];
}
