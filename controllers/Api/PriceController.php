<?php

namespace app\controllers\Api;

use app\models\Category;
use app\models\Price;
use yii\web\Controller;

class PriceController extends Controller
{

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $priceData = Price::PRICE_DATA;
        $priceData = array_merge([0 => ['id' => 0, 'name' => 'Все варианты']], $priceData);

        return $this->asJson($priceData);
    }
}
