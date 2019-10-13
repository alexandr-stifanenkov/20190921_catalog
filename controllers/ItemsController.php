<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\Category;
use app\models\Item;

class ItemsController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays item page.
     *
     * @return string
     */
    public function actionItem($id)
    {
        //Возвращает все записи в виде ассоциативного массива
//        $query = 'SELECT * FROM `menu` ORDER BY type, pos';
//
//        $menu = Yii::$app->db->createCommand($query)
//            ->queryAll();

        // Возвращает только одну колонку, но из всех строк
//        $query = 'SELECT name FROM `menu` ORDER BY type, pos';
//
//        $menu = Yii::$app->db->createCommand($query)
//            ->queryColumn();

        // Возвращает одну строку в виде ассоциативного массива
//        $query = 'SELECT * FROM `menu` ORDER BY type, pos';
//        $menu = Yii::$app->db->createCommand($query)
//            ->queryOne();

        // Возвращает одно скалярное значение
//        $query = 'SELECT COUNT(*) FROM `menu`';
//        $menu = Yii::$app->db->createCommand($query)
//            ->queryScalar();

        $query = 'SELECT * FROM `menu` WHERE type=:typeId AND pos=:pos ORDER BY type, pos';

        $pos = 10;
        $command = Yii::$app->db->createCommand($query)
            ->bindParam(':typeId', $id)
            ->bindParam(':pos', $pos);
//            ->bindValues([
//                ':typeId' => $id,
//                ':pos' => $pos,
//            ]);

        $menu = $command->queryAll();

        echo '<pre>';
        print_r($menu);
        echo '</pre>';

        $pos = 20;
        $menu = $command->queryAll();

        echo '<pre>';
        print_r($menu);
        echo '</pre>';


//        return $this->render('item', ['itemId' => $id]);
    }

    public function actionDo()
    {
//        $result = Yii::$app->db
//            ->createCommand()
//            ->insert(
//                'menu',
//                [
//                    'type' => 3,
//                    'name' => 'Тест',
//                    'pos' => 10
//                ]
//            )
//            ->execute();

//        $query = 'UPDATE `menu` SET `name` = "Новое название" WHERE id=10';
//        $result = Yii::$app->db
//            ->createCommand($query)
//            ->execute();

//        $result = Yii::$app->db->createCommand()
//            ->update(
//                'menu',
//                [
//                    'name' => 'New name'
//                ],
//                'id = 10'
//            )
//            ->execute();

        $result = Yii::$app->db->createCommand()
            ->delete(
                'menu',
                'id = 10'
            )
            ->execute();

        var_dump($result);
        die;
    }

    /**
     * Работа с Query Builder
     */
    public function actionQb()
    {
        // Query Builder - построитель запросов
//        $query = (new \yii\db\Query())
//            ->select('id, name')
//            ->from('items')
//            ->where('id > 2')
//            ->limit(5);
//
//        $query->andWhere('id < 5');
//        $query->orWhere('id = 1');
//
////        echo $query->createCommand()->sql;
//
//        $data = $query->all();

        // Массивы в качестве аргументов
//        $idsList = [1, 3, 5, 7];
//        $catIds = [1, 2];
//
//        $query = (new \yii\db\Query())
//            ->select('*')
//            ->from('items')
//            ->where([
//                'id' => $idsList,
//                'category_id' => $catIds
//            ])
//            ->andWhere('collection_id = :collId', [':collId' => 2]);
//
//        echo $query->createCommand()->sql;
//
//        $data = $query->all();

//        return $this->asJson($data);

//        $subquery = (new \yii\db\Query())
//            ->select('item_id')
//            ->from('items_sizes')
//            ->where(['size_id' => 4]);
//
//        $query = (new \yii\db\Query())
//            ->select('*')
//            ->from('items')
//            ->where(['id' => $subquery]);
//
//        echo $query->createCommand()->sql;
//
//        $data = $query->all();

        // HAVING
//        $itemIds = (new \yii\db\Query())
//            ->select('item_id')
//            ->from('items_sizes')
//            ->where(['size_id' => 4])
//            ->column();
//
//        $query = (new \yii\db\Query())
//            ->select('*')
//            ->from('items')
//            ->where(['id' => $itemIds])
//            ->having('id > 2');

        // SELECT items.* FROM `items`
        // JOIN items_sizes ON items.id = items_sizes.item_id
        // WHERE items_sizes.size_id = 4

        // JOIN, ORDER BY
        $query = (new \yii\db\Query())
            ->select('items.*')
            ->from('items')
            ->join('JOIN', 'items_sizes', 'items.id = items_sizes.item_id')
            ->where('items_sizes.size_id = 4')
            ->orderBy('items.name DESC')
//            ->indexBy('price');
            ->indexBy(function($row) {
                return $row['id'] . '_' . $row['category_id'] . '_' . $row['collection_id'];
            });

        echo $query->createCommand()->sql;

        // Выбирает все записи
        $data = $query->all();

//        // Плоский массив из значений первого столбца
//        $data = $query->column();
//
//        // Только первая запись
//        $data = $query->one();
//
//        // Количество записей
//        $data = $query->count(); // возвращает int
//
//        // Существуют ли записи
//        $data = $query->exists(); // возвращает bool

        echo '<pre>';
        print_r($data);
        echo '</pre>';
        die;
    }

    /**
     * Работа с Active Record
     */
    public function actionAr()
    {
        $item = Item::findOne(1);

        return $this->render('show', ['item' => $item]);
    }

    public function actionNocatsizes()
    {
        $this->actionSizes(1);
    }

    public function actionSizes($categoryId)
    {
        $sizes = \app\models\Size::find()
            ->withCategory($categoryId)
            ->orderBy('pos')
            ->asArray()
            ->all();

        return $this->asJson($sizes);
    }
}
