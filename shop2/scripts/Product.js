class Product {
    constructor(id, name, link, color, size, price, img = 'https://placehold.it/100x115', container = '.cart-content__body'){
        this.id = id;
        this.name = name;
        this.color = color;
        this.link = link;
        this.size = size;
        this.price = price;
        this.img = img;
        this.container = container;
        this._render();
    }
    _render(){
        let $itemCart = $('<div/>', {
            class: 'item-cart'
        });
        let $ic_Card = $('<div/>', {
            class: 'item-cart__card'
        });
        let $ic_CardText = $('<div/>', {
            class: 'item-cart__card-text'
        });
        let $ic_CardName = $('<a/>', {
            href: this.link,
            text: this.name,
            class: 'item-cart__card-name'
        });
       // let $ic_Quantity = $(`<input class="item-cart__list_input" type="text" value="1" title="quantity">`);
        let $ic_CardOptionsColor = $(`<p class="item-cart__card-options">Color: <span class="item-cart__card-value">${this.color}</span></p>`);
        let $ic_CardOptionsSize = $(`<p class="item-cart__card-options">Size: <span class="item-cart__card-value">${this.size}</span></p>`);
        let $ic_Right = $(`<ul class="item-cart__right">` +
            `<li class="item-cart__list">$${this.price}</li>` +
            `<li class="item-cart__list"><input class="item-cart__list_input" type="text" value="1" title="quantity"></li>` +
            `<li class="item-cart__list">FREE</li>` + // todo разобраться с шипингом
            `<li class="item-cart__list subtotal">$${this.price}*</li>` + //todo разобраться с сабтоталом
            `<li class="item-cart__list item-cart__list_action"><a href="#" class="fa fa-times-circle" aria-hidden="true"></a></li></ul>`);
        let $ic_Img = $('<img/>', {
            src: this.img,
            alt: 'Some img'
        });
        $ic_Card.appendTo($itemCart);
        $ic_Right.appendTo($itemCart);
        $ic_Img.appendTo($ic_Card);
        $ic_CardText.appendTo($ic_Card);
        $ic_CardName.appendTo($ic_CardText);
        $ic_CardOptionsColor.appendTo($ic_CardText);
        $ic_CardOptionsSize.appendTo($ic_CardText);
        $(this.container).append($itemCart)
    };
}