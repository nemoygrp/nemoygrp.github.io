<?php
//var_dump($_POST);

?>
<h1>Галерея</h1>
<? if (!empty($message)): ?>
<p><?=$message?></p>
<? endif; ?>
<div class="block_photo">

    <? foreach ($gallery as $item):?>

        <div rel="gallery" id="<?=$item['id']?>" class="photo" ><img src="/img/gallery/<?=$item['name']?>" width="150" height="100" onclick="location.href='/gallery_page/<?=$item['id']?>'"><br>

            <?if ($access == 'admin'):?>
                <a class="photo_close" id="<?=$item['id']?>"><i class="fa fa-times-circle"></i></a>
            <?endif;?>
<div class="info">
    <i class="fa fa-eye" aria-hidden="true"> <?=$item['looks']?>&nbsp;&nbsp;&nbsp;</i>
    <i class="fa fa-heart" aria-hidden="true"> <?=$item['likes']?>&nbsp;&nbsp;&nbsp;</i>
    <i class="fa fa-comments" aria-hidden="true"> <?=$item['commentCount']?></i>
</div>
        </div>

    <? endforeach; ?>
</div>
<div class="block_form_gallery">
    <form method="post" enctype="multipart/form-data" class="form_gallery">
        <input type="file" name="myfile">
        <input type="submit" value="Загрузить" name="load">
    </form>
</div>