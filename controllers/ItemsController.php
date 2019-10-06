<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

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

    public function actionQb()
    {
        // Query Builder - построитель запросов
        $query = (new \yii\db\Query())
            ->select('id, name')
            ->from('items')
            ->where('id > 2')
            ->limit(5);

        $query->andWhere('id < 5');
        $query->orWhere('id = 1');

//        echo $query->createCommand()->sql;

        $data = $query->all();

        return $this->asJson($data);

        echo '<pre>';
        print_r($data);
        echo '</pre>';
        die;
    }
}
