
<?/* foreach ($catalog as $item):?>
<?php var_dump($item)?>
<div class="div"><h2>Наименование:<?=$item['name']?></h2>
<p>Описание <?=$item['description']?></p>
<p>Цена: <?=$item['price']?></p></div>

<? endforeach; */?>

<h1>Каталог</h1>
<div class="block_catalog">
    <? foreach ($catalog as $item):?>
        <div class="catalog_elem">
            <a href="/products/card/<?=$item['id']?>"><img src="/<?=$item['img']?>" alt="photo" width="200" height="150" class="photo_catalog"></a>
            <a href="/products/card/<?=$item['id']?>" class="name_goods"><?=$item['name']?></a>
            <p>Цена: <?=$item['price']?> <i class="fa fa-rub" id="rubles" aria-hidden="true"></i></p>

            <div class="info">
                <i class="fa fa-eye" aria-hidden="true"> <?=$item['looks']?>&nbsp;&nbsp;&nbsp;</i>
                <i class="fa fa-heart" aria-hidden="true"> <?=$item['likes']?>&nbsp;&nbsp;&nbsp;</i>
                <i class="fa fa-comments" aria-hidden="true"> <?=$item['commentCount']?></i>
            </div>
        </div>
    <? endforeach; ?>
</div>