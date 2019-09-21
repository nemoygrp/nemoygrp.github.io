<p><img src="/img/gallery/<?=$params['name']?>" alt="foto" class="alone_image"></p>
    <div class="control">
        <div class="back_form">
            <a class="back ne_knopka" href="/gallery/"><i class="fa fa fa-arrow-left"></i></a>
        </div>
        <div class="count_likes">
            <span id="likeCount"><?= $params['likes'] ?> </span>
            <p>Лайков</p> <br>
            <span><?= $params['looks'] ?> </span>
            <p>Просмотров</p></div>
        <div class="like_form">
            <button class="like ne_knopka fa fa-thumbs-o-up" id="likeButton" data-id="<?=$params['id']?>" data-table="gallery"></button>
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
    <span id="nameComment"><b><?=$userName?></b></span>:
<? else:?>
    <input type="text" id="nameComment" placeholder="Ваше имя" value="">
<?endif;?>
<br>
    <textarea id="textComment" placeholder="Текст отзыва" value="<" cols="60" rows="5"></textarea><br>
    <button class="add_comment" id="main_button" data-id_parent="<?=$params['id']?>"><?=$params['textAction']?></button>



