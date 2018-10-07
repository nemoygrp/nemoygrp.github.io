<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
          integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">

    <script type="text/javascript">
    </script>

</head>
<body>
<div class="container">
    <div class="row header">
        <div class="col">
            <h3>Химия ЕГЭ <?php $d = strtotime("+1 year"); echo date("Y", $d);?> </h3>
        </div>
        <div class="col">
            <ul class="menu">
                <li><a href="#">HOME</a></li>
                <li><a href="#">TESTS</a></li>
                <li><a href="#">OTHER</a></li>
            </ul>
        </div>
    <div class="clr_up"></div>
    </div>

    <div class="row autentic">
        <div class="col-1"></div>
        <div class="col forma">
            <h6>Введите свои данные чтобы начать тестирование</h6>
            <div class="input-group">
                <form method="post" action="tests.php">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="">Имя и фамилия</span>
                </div>
                
                <input type="text" class="form-control" id="name" name="name">
                <input type="text" class="form-control" id="surname" name="surname">
                <input class="btn btn-primary" type="submit" value="Начать">
                </form>
            </div>

        </div>
        <div class="col-1"></div>
    </div>
</div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
            integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
            crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
            integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
            crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"
            integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy"
            crossorigin="anonymous"></script>
</body>
</html>