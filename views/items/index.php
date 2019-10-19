<?php

/* @var $this yii\web\View */

use app\assets\CatalogAsset;

CatalogAsset::register($this);

$this->title = 'Каталог';
?>

<div class="breadcrumbs">
    <a href="" class="breadcrumbs__item">Главная</a>
    <span class="breadcrumbs__item">Мужчинам</span>
</div>
<div class="page-title">
    <h1 class="page-title__headline">МУЖЧИНАМ</h1>
    <div class="page-title__subline">Все товары</div>
</div>
<div class="selector">
    <filter-category
            v-bind:options="catOptions"
            v-bind:title="catTitle"
            @select="categorySelect"
    ></filter-category>

    <filter-size
            v-bind:options="sizeOptions"
            v-bind:title="sizeTitle"
            @select="sizeSelect"
    ></filter-size>

    <filter-cost
            v-bind:options="costOptions"
            v-bind:title="costTitle"
            @select="costSelect"
    ></filter-cost>
</div>

<catalog-items
        v-bind:items="catalogItems"
></catalog-items>

<div class="listing">
    <div class="listing__point">1</div>
    <div class="listing__point listing__point_black">2</div>
    <div class="listing__point listing__point_black">3</div>
    <div class="listing__point listing__point_black">4</div>
</div>
