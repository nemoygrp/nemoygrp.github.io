$(document).ready(() => {
    /**
     * Кнопка "Добавить ЛАЙК"
     */
    $(".like").on('click', function(){
        let id = $("#likeButton").attr("data-id");
        let table = $("#likeButton").attr("data-table");
        $.ajax({
            url: "/ajax/",
            type: "POST",
            dataType : "json",
            data:{
                id: id,
                someData: [{
                    "table": table,
                }],
                change: 'addlike',
            },
            error: function(request) { //Оставлю себе на будущее чтоб не думать чтоже за ошибка
                let statusCode = request.status;
                alert(statusCode);},

            success: function(answer){
                console.log(answer);
                $('#likeCount').html(answer.likes);
            }

        })
    });
    /**
     * Кнопка "Добавить Коммент"
     */
    $(".container").on('click','.add_comment', function(e){
   // $(".add_comment").on('click', function(e){
        let $id = $(e.target).attr("data-id_parent");
        let $name = $("#nameComment").val();
        if ($name == "") {
            $name = $("#nameComment").text();
        }
        let $text = $("#textComment").val();
        let table = $("#likeButton").attr("data-table");
        $.ajax({
            url: "/ajax/",
            type: "POST",
            dataType : "json",
            data:{
                id_parent: $id,
                someData: [{
                        "name": $name,
                        "text": $text,
                        "table": table,

                 }],
                change: 'addComment',
            },
            error: function(request) { //Оставлю себе на будущее чтоб не думать чтоже за ошибка
                let statusCode = request.status;
                alert(statusCode);},
            success: function(answer){
                console.log(answer);
               let $id_new_message = answer.id_new_message;
                let $feedback_elem = $('<div/>', {
                    class: 'feedback_elem',
                    id: `${$id_new_message}`
                });
                let $message = $(`<p><b>${$name}</b>:<br>${$text}
                        <button class="edit_comment ne_knopka fa fa-pencil" data-id="${$id_new_message}"></button>
                        <button class="delete_comment ne_knopka fa fa-times" data-id="${$id_new_message}"></button> 
                         </p>`);
                $message.appendTo($feedback_elem);
                $('.comment_block').prepend($feedback_elem);
                $feedback_elem.css("backgroundColor","lightgreen");
                $('#nameComment').val("");
                $('#textComment').val("");
            }

        })
    });
    /**
     * Кнопка "Удалить коммент"
     */
    $(".comment_block").on('click','.delete_comment', function(e){
   // $(".delete_comment").on('click', function(e){
        let id = $(e.target).attr("data-id");
        let id_parent = $("#likeButton").attr("data-id");
        let table = $("#likeButton").attr("data-table");
        $.ajax({
            url: "/ajax/",
            type: "POST",
            dataType : "json",
            data:{
                id: id,
                id_parent: id_parent,
                someData: [{
                    "table": table,
                }],
                change: 'delComment',
            },
            error: function() {alert("Что-то пошло не так...");},
            success: function(answer){
                let $id_block = "#" + answer.id_block;
                $($id_block).html("<p>Сообщение удалено</p>");
                $($id_block).css("backgroundColor","pink");
            }

        })
    });
    /**
     * Кнопка "Править коммент"
     */
    $(".comment_block").on('click','.edit_comment', function(e){
    //$(".edit_comment").on('click', function(e){
        let id = $(e.target).attr("data-id");

        $.ajax({
            url: "/ajax/",
            type: "POST",
            dataType : "json",
            data:{
                id: id,
                change: 'editComment',
            },
            error: function() {alert("Что-то пошло не так...");},
            success: function(answer){
                console.log(answer);
                $('#id_comment').val(answer.id);
                $('#nameComment').val(answer.name);
                $('#textComment').val(answer.message);
                $('#main_button').removeClass();
                $('#main_button').addClass("confirm_edit_comment");
                $('#main_button').html("Править");
            }

        })
    });
    /**
     * Кнопка "Отправить исправление"
     */
    $(".container").on('click','.confirm_edit_comment', function(e){
        // $(".add_comment").on('click', function(e){
        let $id = $("#id_comment").val();
        let $name = $("#nameComment").val();
        let $text = $("#textComment").val();
        console.log($id);
        $.ajax({
            url: "/ajax/",
            type: "POST",
            dataType : "json",
            data:{
                id: $id,
                someData: [{
                    "name": $name,
                    "text": $text,
                }],
                change: 'confirmEditComment',
            },
            error: function() {alert("Что-то пошло не так...");},
            success: function(answer){
                console.log(answer);
                let $id_block = "#" + $id;
                $($id_block).remove();
                let $feedback_elem = $('<div/>', {
                    class: 'feedback_elem',
                    id: `${$id}`
                });
                let $message = $(`<p><b>${answer.name}</b>:<br>${answer.message}
                        <button class="edit_comment ne_knopka fa fa-pencil" data-id="${$id}"></button>
                        <button class="delete_comment ne_knopka fa fa-times" data-id="${$id}"></button> 
                         </p>`);
                $message.appendTo($feedback_elem);
                $('.comment_block').prepend($feedback_elem);
                $feedback_elem.css("backgroundColor","lightblue");
                $('#id_comment').val("");
                $('#nameComment').val("");
                $('#textComment').val("");
                $('#main_button').removeClass();
                $('#main_button').addClass("add_comment");
                $('#main_button').html("Добавить");
            }

        })
    });
    /**
     * Кнопка "Купить товар"
     */
    $(".container").on('click','.buy_Item', function(e){

        let $id = $(e.target).attr("data-id_goods");
        let $elem_id = $("#elem_id_"+$id);
        let $elem_quant = $("#quant_id_"+$id);
        let $elem_quant_int = parseInt($elem_quant.html());

        $.ajax({
            url: "/ajax/",
            type: "POST",
            dataType : "json",
            data:{
                id: $id,
                change: 'buyItem',
            },
            error: function(request) { //Оставлю себе на будущее чтоб не думать чтоже за ошибка
                let statusCode = request.status;
                alert(statusCode);},
            success: function(answer){
                console.log(answer);
                if ($elem_quant_int > 0) {
                    $elem_quant.html(++$elem_quant_int + " шт.");
                } else {
                    let $itemCart = $('<div/>', {
                        class: 'mini_cart_elem',
                        id: `elem_id_${answer.id_goods}`
                    });
                    let $icPhoto = $('<div/>', {
                        class: 'mini_cart_elem__photo',
                    });
                    let $ic_Img = $('<img/>', {
                        src: `/${answer.img}`,
                        alt: 'foto',
                        width: '100',
                        height: '80'
                    });
                    let $icDelBut = $(`<div class="mini_cart_elem__delete button_delete" id="${answer.id_goods}"><i class="fa fa-times-circle"></i></div>`);
                    let $icName = $(`<div class="mini_cart_elem__name">${answer.name}</div>`);
                    let $icQuant = $(`<div class="mini_cart_elem__quantity" id="quant_id_${answer.id_goods}">1 шт.</div>`);
                    let $icPrice = $(`<div class="mini_cart_elem__price">${answer.price} <i class="fa fa-rub" id="rubles" aria-hidden="true"></i></div>`);
                    $ic_Img.appendTo($icPhoto);
                    $icPhoto.appendTo($itemCart);
                    $icDelBut.appendTo($itemCart);
                    $icName.appendTo($itemCart);
                    $icQuant.appendTo($itemCart);
                    $icPrice.appendTo($itemCart);
                    $('.mini_cart_goods_block').append($itemCart)

                }
                let $summ = +($('#summ_mini_card').html());
                let $result = $summ + (+(answer.price));
                $('#summ_mini_card').html($result);
                let $num = $('#cart_Count').html();
                $('#cart_Count').html(++$num);
            }

        })
    });
});
/**
 * Кнопка "Удалить товар"
 */
$(".container").on('click','.button_delete', function(e){
    // $(".delete_comment").on('click', function(e){
    let $id = this.id;
    let $elem_id = $("#elem_id_"+$id);
    let $elem_quant = $("#quant_id_"+$id);
    let $elem_quant_int = parseInt($elem_quant.html());
    $.ajax({
        url: "/ajax/",
        type: "POST",
        dataType : "json",
        data:{
            id: $id,
            change: 'delGoodFromCart',
        },
        error: function(request) {
            let statusCode = request.status;
            alert(statusCode);},

        success: function (answer) {
            console.log(answer);
            if ($elem_quant_int === 1) {
                $elem_id.remove();
            } else {
                $elem_quant.html(--$elem_quant_int + " шт.");
            }
            let $summ = +($('#summ_mini_card').html());
            let $result = $summ - (+(answer.price));
            $('#summ_mini_card').html($result);

            let $num = $('#cart_Count').html();
            $('#cart_Count').html(--$num);
        }

    })
});
/**
 * Кнопка "Удалить фото из галереии"
 */
$(".photo").on('click','.photo_close', function(){

    let id = this.id;

    $.ajax({
        url: "/ajax/",
        type: "POST",
        dataType : "json",
        data:{
            id: id,
            change: 'delImageFromGallery',
        },
        error: function() {alert("Что-то пошло не так...");},
        success: function(answer){
            console.log(answer);
            let $id_block = "#" + answer.id_block;
            $($id_block).remove();

        }

    })
});

/**
 * Кнопка "Править status"
 */
$(".order_elem_control").on('click','.button_status', function(e){
    let $id = $(e.target).attr("data-id");
    let $newStatus = $(e.target).attr("data-status");
    let $status_label = $('#status_order_'+$id);
    $.ajax({
        url: "/ajax/",
        type: "POST",
        dataType : "json",
        data:{
            id: $id,
            someData: [{
                "newStatus": $newStatus
            }],
            change: 'updateStatus',
        },
        error: function() {alert("Что-то пошло не так...");},
        success: function(answer){
            switch ($newStatus) {
                case 'Заказ отменен':
                    $($status_label).html("");
                    $($status_label).html($newStatus);
                    $($status_label).css('backgroundColor', 'lightcoral');
                    break;
                case 'Заказ подтвержден':
                    $($status_label).html("");
                    $($status_label).html($newStatus);
                    $($status_label).css('backgroundColor', 'lightgreen');
                    break;
                case 'Заказ отправлен':
                    $($status_label).html("");
                    $($status_label).html($newStatus);
                    $($status_label).css('backgroundColor', 'lightseagreen');
                    break;
                case 'Заказ доставлен':
                    $($status_label).html("");
                    $($status_label).html($newStatus);
                    $($status_label).css('backgroundColor', 'lightgrey');
                    break;
            }
        }

    })
});
/**
 * Кнопка "Править элемент в таблицах админ панели"
 */
$(".admin_block_content").on('click','.confirm_edit_list_elem_admin-panel', function(e){
    let $id = $(e.target).attr("data-id");
    let $row = $("#catalog_id_"+$id);
    let $name = $row.find(".catalog_list_elem_name input");
    let $price = $row.find(".catalog_list_elem_price input");
    let $discount = $row.find(".catalog_list_elem_discount input");
    let $img = $row.find(".catalog_list_elem_img input");
    let $likes = $row.find(".catalog_list_elem_likes").html();
    let $looks = $row.find(".catalog_list_elem_looks").html();
    let $comment = $row.find(".catalog_list_elem_comment").html();
    let $control = $row.find(".catalog_list_elem_control");

    $.ajax({
        url: "/ajax/",
        type: "POST",
        dataType : "json",
        data:{
            id: $id,
            someData: [{
                "name": $name.val(),
                "price": $price.val(),
                "discount": $discount.val(),
                "img": $img.val()

            }],
            change: 'confirmEditElemListAP',
        },
        error: function() {alert("Что-то пошло не так...");},
        success: function(answer){
            console.log(answer);
            $row.find(".catalog_list_elem_name").html(answer.name);
            $row.find(".catalog_list_elem_price").html(answer.price);
            $row.find(".catalog_list_elem_discount").html(answer.discount);
            $row.find(".catalog_list_elem_img").html(answer.img);
            $row.find(".catalog_list_elem_likes").html($likes);
            $row.find(".catalog_list_elem_looks").html($looks);
            $row.find(".catalog_list_elem_comment").html($comment);
            $control.html('<button class="edit_list_elem_admin-panel ne_knopka fa fa-pencil" data-id="'+answer.id+'"></button> <button class="delete_elem_admin-panel ne_knopka fa fa-times" data-id="'+answer.id+'"></button>');
        }
    })
});
/**
 * Кнопка "Править элемент"
 */
$(".catalog_list_elem").on('click','.edit_list_elem_admin-panel', function(e){

    let $id = $(e.target).attr("data-id");
    let $row = $("#catalog_id_"+$id);
    let $name = $row.find(".catalog_list_elem_name");
    let $img = $row.find(".catalog_list_elem_img");
    let $price = $row.find(".catalog_list_elem_price");
    let $discount = $row.find(".catalog_list_elem_discount");
    let $control = $row.find(".catalog_list_elem_control");

    $.ajax({
        url: "/ajax/",
        type: "POST",
        dataType : "json",
        data:{
            id: $id,
            change: 'editElemListAP',
        },
        error: function() {alert("Что-то пошло не так...");},
        success: function(answer){
            console.log(answer);
            $name.html('<input type="text" value="'+answer.name+'">');
            $img.html('<input type="text" size="15" value="'+answer.img+'">');
            $price.html('<input type="text" size="3" value="'+answer.price+'">');
            $discount.html('<input type="text" size="1" value="'+answer.discount+'">');
            $control.html('<button class="confirm_edit_list_elem_admin-panel ne_knopka fa fa-check" data-id="'+answer.id+'"></button>');

        }

    })
});

/**
 * Кнопка "Добавить элемент"
 */
$(".admin_block_content").on('click','.add_elem_admin-panel', function(e){
    $.ajax({
        url: "/ajax/",
        type: "POST",
        dataType : "json",
        data:{
            change: 'addElemListAP',
        },
        error: function() {alert("Что-то пошло не так...");},
        success: function(answer){
            console.log(answer);
            let $newRow = $('<tr/>', {
                class: 'catalog_list_elem',
                id: "catalog_id_"+ answer.lastID
            });
            let $id = $('<td class="catalog_list_elem_id">'+answer.lastID+'</td>');
            let $name = $('<td class="catalog_list_elem_name"><input type="text" value=""></td>');
            let $img = $('<td class="catalog_list_elem_img"><input type="text" size="15" value=""></td>');
            let $price = $('<td class="catalog_list_elem_price"><input type="text" size="3" value=""></td>');
            let $discount = $('<td class="catalog_list_elem_discount"><input type="text" size="1" value=""></td>');
            let $likes = $('<td class="catalog_list_elem_likes">0</td>');
            let $looks = $('<td class="catalog_list_elem_looks">0</td>');
            let $comments = $('<td class="catalog_list_elem_comments">0</td>');
            let $control = $('<td class="catalog_list_elem_control"><button class="confirm_edit_list_elem_admin-panel ne_knopka fa fa-check" data-id="'+answer.lastID+'"></button></td>');

            $id.appendTo($newRow);
            $name.appendTo($newRow);
            $img.appendTo($newRow);
            $price.appendTo($newRow);
            $discount.appendTo($newRow);
            $likes.appendTo($newRow);
            $looks.appendTo($newRow);
            $comments.appendTo($newRow);
            $control.appendTo($newRow);
            $('.catalog_db').append($newRow)
        }

    })
});

/**
 * Кнопка "Удалить элемент"
 */
$(".catalog_list_elem").on('click','.delete_elem_admin-panel', function(e){
    let $id = $(e.target).attr("data-id");
    let $row = $("#catalog_id_"+$id);

    $.ajax({
        url: "/ajax/",
        type: "POST",
        dataType : "json",
        data:{
            id: $id,
            change: 'delElemListAP',
        },
        error: function() {alert("Что-то пошло не так...");},
        success: function(answer){
            $row.remove()
        }

    })
});