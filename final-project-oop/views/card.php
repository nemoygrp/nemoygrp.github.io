<?php
/** @var \app\model\Products $products*/
//var_dump($comments);
?>


<div class="goods_block">
    <div class="imgGoods"><img src="/<?=$products->img?>" alt="foto" class="alone_goods"></div>
    <div class="cardGoods">
        <h3><?=$products->name?></h3>
        <p>Описание <?=$products->description?></p>
        <p>Цена: <span><?=$products->price?></span> руб.</p>
        <button class="buy_Item" data-id_goods="<?=$products->id?>">Купить</button>
    </div>
</div>
<div class="control">
    <div class="back_form">
        <a class="back ne_knopka" href="/products/"><i class="fa fa fa-arrow-left"></i></a>
    </div>
    <div class="count_likes">
        <span id="likeCount"><?=$products->likes?> </span>
        <p>Лайков</p> <br>
        <span><?=$products->looks?> </span>
        <p>Просмотров</p></div>
    <div class="like_form">
        <button class="like ne_knopka fa fa-thumbs-o-up" id="likeButton" data-id="<?=$products->id?>" data-table="products"></button>
    </div>

</div>
<div class="comment_block">
    <? foreach ($comments as $item):?>
        <div class="feedback_elem" id="<?=$item['id']?>">
            <p><b><?= $item['name'] ?></b>:<br> <?= $item['feedback'] ?>
                <?if ($access == 'admin' || $item['name'] == $userName):?>
                    <button class="edit_comment ne_knopka fa fa-pencil" data-id="<?=$item['id']?>"></button>
                    <button class="delete_comment ne_knopka fa fa-times" data-id="<?=$item['id']?>"></button>
                <?endif;?>
            </p>
        </div>
    <? endforeach;?>
</div>
<input hidden type="text" id="id_comment" value=""><br>
<?if (!empty($userName)):?>
    <span data-auth="true" id="nameComment"><b><?=$userName?></b></span>:
<? else:?>
    <input data-auth="false" type="text" id="nameComment" placeholder="Ваше имя" value="">
<?endif;?>
<br>
<textarea id="textComment" placeholder="Текст отзыва" value="<" cols="60" rows="5"></textarea><br>
<button class="add_comment" id="main_button" data-id_parent="<?=$products->id?>"><?=$products->textAction?></button>