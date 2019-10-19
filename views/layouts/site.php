<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use app\assets\SiteAsset;

SiteAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
<div class="wrapper" id="app">
    <header class="header">
        <div class="header-nav">
            <a href="" class="header-nav__logo"></a>
            <nav class="menu">
<?php foreach ($this->params['headerMenu'] as $point): ?>
                <a href="" class="menu__item"><?=$point['name']; ?></a>
<?php endforeach; ?>
            </nav>
        </div>

        <div class="user-area">
            <div class="user mr-20">
                <div class="user__text">Привет, Алексей (<a href="" class="user__logout color-highlight">выйти</a>)</div>
            </div>
            <div class="basket">
                <div class="basket__text">Корзина(5)</div>
            </div>
        </div>
    </header>

<?= $content ?>

    <div class="footer margin-top-zero">
        <div class="footer__block">
            <h2 class="footer__title">КОЛЛЕКЦИИ</h2>
<?php foreach ($this->params['footerMenu'] as $point): ?>
            <a href="" class="footer__link"><?=$point['name']; ?></a>
<?php endforeach; ?>
        </div>
        <div class="footer__divider"></div>
        <div class="footer__block">
            <h2 class="footer__title">МАГАЗИН</h2>
            <a class="footer__link" href="">О нас</a>
            <a class="footer__link" href="">Доставка</a>
            <a class="footer__link" href="">Работай с нами</a>
            <a class="footer__link" href="">Контакты</a>
        </div>
        <div class="footer__divider"></div>
        <div class="footer__block">
            <h2 class="footer__title">МЫ В СОЦ СЕТЯХ</h2>
            <a class="footer__link" href="">сайт разработан в inordic.ru</a>
            <a class="footer__link" href="">2018 © Все права защищены</a>
            <a class="footer__social-link twitter" href=""></a>
            <a class="footer__social-link facebook" href=""></a>
            <a class="footer__social-link instagram" href=""></a>
        </div>
    </div>
</div>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
