<h1>Регистрация</h1>
<script>
    $(document).ready(() => {
        $('.register_phone').mask('+7 (000) 000-00-00',{placeholder: "+7 (___) ___-__-__"});
    });
</script>
<div class="register_block">
    <form method="post" action="/reg/">
        <input class="input_text register_login" id="reg_login" type="text" name="login" placeholder="Введите логин" required pattern="^[a-zA-Z0-9]+$" autofocus><br>
        <input class="input_text register_pass" id="reg_pass" type="password" name="pass" placeholder="Введите пароль" required pattern="^[a-zA-Z0-9]+$"><br>
        <input class="input_text register_name" id="reg_name" type="text" name="name" placeholder="Введите имя" required pattern="^[а-яА-ЯёЁa-zA-Z0-9]+$"><br>
        <input class="input_text register_phone" id="reg_phone" type="text" name="phone"><br>
        <input class="input_text register_email" id="reg_email" type="email" name="email" required pattern="\S+@[a-z]+.[a-z]+" placeholder="email@server.com"><br>

        <input class="input_button" type="submit" name="send" value="Зарегистрироваться" >
    </form>
</div>
