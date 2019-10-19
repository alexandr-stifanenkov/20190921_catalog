<?php

namespace app\controllers\Api;

use app\models\Category;
use app\models\Item;
use app\models\Price;
use yii\web\Controller;

class CategoryController extends Controller
{

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $categories = Category::find()
            ->select(['id', 'name'])
            ->orderBy('pos')
            ->asArray()
            ->all();

        $categories = array_merge(
            [
                0 => [
                    'id' => 0,
                    'name' => 'Все категории'
                ]
            ],
            $categories
        );

        return $this->asJson($categories);
    }
}
