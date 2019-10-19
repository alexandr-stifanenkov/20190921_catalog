<?php

namespace app\controllers\Api;

use app\models\Item;
use app\models\Price;
use app\models\Size;
use yii\web\Controller;

class SizeController extends Controller
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

        $sizes = Size::find()
            ->select(['id', 'name'])
            ->where(['category_id' => $categoryId])
            ->asArray()
            ->all();

        $sizes = array_merge([0 => ['id' => 0, 'name' => 'Все размеры']], $sizes);

        return $this->asJson($sizes);
    }

    public function actionItem($itemId)
    {
        return $this->render('item');
    }
}
