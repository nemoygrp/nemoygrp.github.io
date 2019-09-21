<div class="admin_block_head"><h3>Глобальное управление сайтом</h3>
    <div class="admin_block_control__site">

    </div>

</div>
<div class="admin_block">
    <div class="admin_block_title"><h3>Управление каталогом товаров</h3><p> В демо режиме(без воздействия на базу)</p></div>
    <div class="admin_block_content">
        <div class="edit_inputs"></div>
    <table class="catalog_db">
        <th>id</th>
        <th>name</th>
        <th>img</th>
        <th>price</th>
        <th>discount</th>
        <th>likes</th>
        <th>looks</th>
        <th>com</th>
        <th>control</th>
    <? foreach ($catalog as $item):?>
        <tr class="catalog_list_elem" id="catalog_id_<?=$item['id']?>">
            <td class="catalog_list_elem_id"><?=$item['id']?></td>
            <td class="catalog_list_elem_name"><?=$item['name']?></td>
            <td class="catalog_list_elem_img"><?=$item['img']?></td>
            <td class="catalog_list_elem_price"><?=$item['price']?></td>
            <td class="catalog_list_elem_discount"><?=$item['discount']?></td>
            <td class="catalog_list_elem_likes"><?=$item['likes']?></td>
            <td class="catalog_list_elem_looks"><?=$item['looks']?></td>
            <td class="catalog_list_elem_comments"><?=$item['commentCount']?></td>
            <td class="catalog_list_elem_control"> <button class="edit_list_elem_admin-panel ne_knopka fa fa-pencil" data-id="<?=$item['id']?>"></button>
                <button class="delete_elem_admin-panel ne_knopka fa fa-times" data-id="<?=$item['id']?>"></button></td>
        </tr>
    <? endforeach;?>
    </table>
        <button class="add_elem_admin-panel ne_knopka fa fa-plus"></button>
    </div>
    <div class="admin_block_title"><h3>Управление галереей</h3><br><p> Заготовка надо лишь поправить функционал с каталога</p></div>
    <div class="admin_block_content">
        <table>
            <th>id</th>
            <th>name</th>
            <th>likes</th>
            <th>looks</th>
            <th>comments</th>
            <th>control</th>
            <? foreach ($gallery as $item):?>
                <tr>
                    <td><?=$item['id']?></td>
                    <td><?=$item['name']?></td>
                    <td><?=$item['likes']?></td>
                    <td><?=$item['looks']?></td>
                    <td><?=$item['commentCount']?></td>
                    <td> <button class="edit_comment ne_knopka fa fa-pencil" data-id="<?=$item['id']?>"></button>
                        <button class="delete_comment ne_knopka fa fa-times" data-id="<?=$item['id']?>"></button></td>
                </tr>
            <? endforeach;?>
        </table>
    </div>
    <div class="admin_block_title"><h3>Управление пользователями</h3><br><p> Заготовка надо лишь поправить функционал с каталога</p></div>
    <div class="admin_block_content">
        <table>
            <th>id</th>
            <th>access</th>
            <th>login</th>
            <th>name</th>
            <th>phone</th>
            <th>email</th>
            <th>control</th>
            <? foreach ($allUsers as $item):?>
                <tr>
                    <td><?=$item['id']?></td>
                    <td><?=$item['access']?></td>
                    <td><?=$item['login']?></td>
                    <td><?=$item['name']?></td>
                    <td><?=$item['phone']?></td>
                    <td><?=$item['email']?></td>
                    <td> <button class="edit_comment ne_knopka fa fa-pencil" data-id="<?=$item['id']?>"></button>
                        <button class="delete_comment ne_knopka fa fa-times" data-id="<?=$item['id']?>"></button></td>
                </tr>
            <? endforeach;?>
        </table>
    </div>
    <div class="admin_block_title"><h3>Управление системой ядерной безопасности КНДР</h3></div>
    <div class="admin_block_content"><img src="/img/7.jpg" alt="бахнем?" width="500" height="300"> </div>
</div>
