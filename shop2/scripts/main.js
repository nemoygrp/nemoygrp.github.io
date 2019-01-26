$(document).ready(() => {
    //Корзина
    let cart = new Cart('scripts/getCart.json');

    //Добавление товара //TODO Недопилено добавление товара, надо подумать, рендерить ли товары через скрипт или вручную прописывать дата ко всем карточкам
    /*$('.add-to-cart').click(e => {
        event.preventDefault();
        cart.addProduct(e.target);
    });*/

    //Удаление товара
    $('.cart-content__body').on('click','.remove_btn', e => {
        event.preventDefault();
        cart.remove(+$((e.target).closest('.item-cart')).data('product'));
    });
    $('.cart-box-items').on('click','.remove_btn', e => {
        event.preventDefault();
        cart.remove(+$((e.target).closest('.cart-box-item')).data('product'))
    });
    //Изменение кол-ва товара
    $(document).on("focusout",".item-cart__list_input", e => {
        cart.renderTotal(+$((e.target).closest('.item-cart')).data('product'),$(e.target).val());
    });
    // Очистка корзины
    $('.cart-content').on('click','.clear_cart', e => {
        event.preventDefault();
        cart.clearCart();
    });
});