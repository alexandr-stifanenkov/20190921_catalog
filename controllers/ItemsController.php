<?php

namespace app\controllers;

class ItemsController extends BaseController
{
    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionItem($itemId)
    {
        return $this->render('item');
    }
}
