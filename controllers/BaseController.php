<?php

namespace app\controllers;

use app\models\Menu;
use yii\web\Controller;

class BaseController extends Controller
{
    public $layout = 'site';

    public function beforeAction($action)
    {
        $this->view->params = [
            'headerMenu' => Menu::find()->headerMenu(),
            'footerMenu' => Menu::find()->footerMenu(),
        ];

        return parent::beforeAction($action);
    }
}
