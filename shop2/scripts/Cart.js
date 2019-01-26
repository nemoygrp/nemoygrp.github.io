class Cart {
    constructor(source, container = '.cart-content__body'){
        this.source = source;
        this.container = container;
        this.countGoods = 0; // Общее кол-во товаров в корзине
        this.amount = 0; // Общая стоимость товаров в корзине
        this.cartItems = []; //Массив для хранения товаров
        this._init(this.source);
    }

    _init(source){
      //  this._render();
        fetch(source)
            .then(result => result.json())
            .then(data => {
                for (let product of data.contents){
                    this.cartItems.push(product);
                    this._renderItem(product);
                    this._renderItemBox(product);
                }
                this._renderSum();
            })
    }
    _renderItem(product){
        let $itemCart = $('<div/>', {
            class: 'item-cart',
            'data-product': product.id_product
        });
        let $ic_Card = $('<div/>', {
            class: 'item-cart__card'
        });
        let $ic_CardText = $('<div/>', {
            class: 'item-cart__card-text'
        });
        let $ic_CardName = $('<a/>', {
            href: `${product.link}`,
            text: `${product.product_name}`,
            class: 'item-cart__card-name'
        });
        let $ic_CardOptionsColor = $(`<p class="item-cart__card-options">Color: <span class="item-cart__card-value">${product.color}</span></p>`);
        let $ic_CardOptionsSize = $(`<p class="item-cart__card-options">Size: <span class="item-cart__card-value">${product.size}</span></p>`);
        let $ic_Right = $(`<ul class="item-cart__right">` +
            `<li class="item-cart__list">$${product.price}</li>` +
            `<li class="item-cart__list"><input class="item-cart__list_input" type="text" value="${product.quantity}" title="quantity"></li>` +
            `<li class="item-cart__list">FREE</li>` + // todo разобраться с шипингом
            `<li class="item-cart__list"><span>$</span><span class="subtotal">${product.quantity*product.price}</span></li>` +
            `<li class="item-cart__list item-cart__list_action"><a href="#" class="fa fa-times-circle remove_btn" aria-hidden="true"></a></li></ul>`);
        let $ic_Img = $('<img/>', {
            src: `${product.img}`,
            alt: 'Some img',
            width: '100',
            height: '115'
        });
        $ic_Card.appendTo($itemCart);
        $ic_Right.appendTo($itemCart);
        $ic_Img.appendTo($ic_Card);
        $ic_CardText.appendTo($ic_Card);
        $ic_CardName.appendTo($ic_CardText);
        $ic_CardOptionsColor.appendTo($ic_CardText);
        $ic_CardOptionsSize.appendTo($ic_CardText);
        $(this.container).append($itemCart)
    }
    _renderItemBox(product){
        let $icb_Item = $('<div/>', {
            class: 'cart-box-item',
            'data-product': product.id_product
        });
        let $icb_Img_contain = $('<div/>', {
            class: 'cart-box-item__img'
        });
        let $icb_Text = $('<div/>', {
            class: 'cart-box-item__text'
        });
        let $icb_Img = $('<img/>', {
            src: `${product.img}`,
            alt: 'Some img',
            width: '72',
            height: '85'
        });
        let $icb_Name = $('<a/>', {
            href: `${product.link}`,
            text: `${product.product_name}`,
            class: 'cart-box-item__text_name'
        });
        let $icb_Stars = $(`<p class="cart-box-item__text_star">` +
            `<i class="fa fa-star" aria-hidden="true"></i>` +
            `<i class="fa fa-star" aria-hidden="true"></i>` +
            `<i class="fa fa-star" aria-hidden="true"></i>` +
            `<i class="fa fa-star" aria-hidden="true"></i>` +
            `<i class="fa fa-star-half-o" aria-hidden="true"></i></p>`);
        let $icb_Price = $(`<p class="cart-box-item__text_price">` +
            `<span class="cart-box-item__text_price_quantity">${product.quantity}</span>` + ` X $` +
            `<span class="cart-box-item__text_price_val">${product.price}</span><span class="cart-box-item__text_price_sub">${product.quantity*product.price}</span></p>`);
        let $icb_Cancel = $(`<div class="cart-box-item__cancel"><a href="#" class="fa fa-times-circle remove_btn" aria-hidden="true"></a></div>`);

        $icb_Img_contain.appendTo($icb_Item);
        $icb_Text.appendTo($icb_Item);
        $icb_Cancel.appendTo($icb_Item);
        $icb_Img.appendTo($icb_Img_contain);
        $icb_Name.appendTo($icb_Text);
        $icb_Stars.appendTo($icb_Text);
        $icb_Price.appendTo($icb_Text);
        $('.cart-box-items').append($icb_Item);
    }
    _renderSum(){
        this.amount = 0;
        let $sub = $(this.container).find('.subtotal');
        for (let subAmount of $sub) {
            this.amount += +($(subAmount).html());
        }
        if(this.amount === 0){
            let $subBox = $('.cart-box-items').find('.cart-box-item__text_price_sub');
            for (let subAmountBox of $subBox) {
                this.amount += +($(subAmountBox).html());
            }
        }
        $('.shipping-content__price').text(`$${this.amount}`);
        $('.cart-box-item__total_amount').text(`$${this.amount}`);
        this._renderCount()
    }
    _renderCount() {
        let $clear = $('<div/>', {
            class: 'clear_item',
            text: `Cart is empty =(`
        });
        this.countGoods = 0;
        let $countAll = $(this.container).find('.item-cart__list_input');
        for (let subCount of $countAll) {
            this.countGoods += +($(subCount).val());
        }
        if (this.countGoods === 0) {
            $(this.container).append($clear);
            console.log(this.countGoods);
            let $countAllBox = $('.cart-box-items').find('.cart-box-item__text_price_quantity');
            for (let subCount of $countAllBox) {
                this.countGoods += +($(subCount).text());
            }
            if (this.countGoods === 0) {
                $('.cart-box-items').append($clear);
                $(this.container).append($clear);
                $('.img_cart_link__quantity').css({'opacity': '0'});
            } else {
                $('.img_cart_link__quantity').css({'opacity': '1'});
                $('.img_cart_link__quantity').text(this.countGoods);
            }
        } else {
            $('.img_cart_link__quantity').css({'opacity': '1'});
            $('.img_cart_link__quantity').text(this.countGoods);
        }
    }
    renderTotal(idProduct, quantity){
        let $find = this.cartItems.find(product => product.id_product === idProduct);
        $find.quantity = +quantity;
        let $subtotal = $find.quantity * $find.price;
        let $container = $(`div[data-product=${idProduct}]`);
        if(+quantity >= 1) {
            $container.find('.subtotal').text($subtotal);
            $container.find('.cart-box-item__text_price_quantity').text(quantity);
        } else if (+quantity === 0){
            $container.remove();
            this.cartItems.splice($.inArray($find, this.cartItems), 1);
            this.amount -= $find.price;
            this.countGoods -= $find.quantity;
        } else {
            this.renderTotal(idProduct,1)
        }
        this._renderSum();
    }
   _updateCart(product){
        let $container = $(`div[data-product=${product.id_product}]`);
        $container.find('.item-cart__list_input').val(product.quantity);
        $container.find('.cart-box-item__text_price_quantity').text(product.quantity);
        $container.find('.subtotal').text(product.quantity*product.price);
    }
    /*addProduct(element){
        let productId = +$(element).data('id');
        let find = this.cartItems.find(product => product.id_product === productId);
        if (find){
            find.quantity++;
            this.countGoods++;
            this.amount += find.price;
            this._updateCart(find);
        } else {
            let product = {
                id_product: productId,
                product_name: $(element).data('name'),
                price: +$(element).data('price'),
                quantity: 1
            };
            this.cartItems.push(product);
            this.amount += product.price;
            this.countGoods += product.quantity;
            this._renderItem(product);
        }
        this._renderSum();
    }*/
    remove(idProduct){
        let elem = this.cartItems.find(product => product.id_product === idProduct);
        let detect_quantity = +elem.quantity;
        if (detect_quantity === 1){
            $(`div[data-product=${elem.id_product}]`).remove();
            this.cartItems.splice($.inArray(elem, this.cartItems), 1);
            this.amount -= elem.price;
            this.countGoods -= elem.quantity;
        } else {
            elem.quantity--;
            this.countGoods--;
            this.amount -= elem.price;
            this._updateCart(elem);
        }
        this._renderSum();
    }
    clearCart(){
        $(`div.cart-box-item`).remove();
        $(`div.item-cart`).remove();
        this.cartItems.splice(0,$(this.cartItems).length);
        this._renderSum();
    }
}