<?php

namespace app\controllers\Api;

use app\models\Item;
use app\models\Price;
use yii\web\Controller;

class ItemsController extends Controller
{

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $request = \Yii::$app->request;

        $categoryId = (int)$request->get('category', 0);
        $sizeId = (int)$request->get('size', 0);
        $costId = (int)$request->get('cost', 0);

        $items = Item::find();
        if ($categoryId > 0) {
            $items->where(['category_id' => $categoryId]);
        }
        if ($sizeId > 0) {
            $items->bySize($sizeId);
        }
        if (array_key_exists($costId, Price::PRICE_DATA)) {
            $from = Price::PRICE_DATA[$costId]['from'];
            $to = Price::PRICE_DATA[$costId]['till'];
            $items->andWhere(['between', 'price', $from, $to]);
        }

        // Поиск по названию (в порядке информации)
//        $items->andWhere(['like', 'name', '%query%']);

        $items = $items->all();

        return $this->asJson($items);
    }

    public function actionItem($itemId)
    {
        return $this->render('item');
    }
}
