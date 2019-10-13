<?php

/* @var $this yii\web\View */
/* @var $item \app\models\Item */

$this->title = 'Товар каталога';
?>
<div class="site-index">
    <h2>Товар №<?=$item->id; ?>: <?=$item->name; ?></h2>

    <div>Название категории: <?=$item->category->name; ?></div>
    <div>Название коллекции: <?=$item->collection->name; ?></div>
    <div>Доступные размеры:</div>
    <ul>
<?php foreach ($item->sizes as $size): ?>
        <li><?= $size['name']; ?></li>
<?php endforeach; ?>
    </ul>
</div>
