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
                <li><a href="index.php">HOME</a></li>
                <li><a href="index.php">TESTS</a></li>
                <li><a href="#">OTHER</a></li>
            </ul>
        </div>
    </div>
    <div class="clr_up">
        
    </div>
<?php 
$name = $_POST["name"];//ловим имя
$translit_name = translitText($name);
$surname = $_POST["surname"];//ловим фамилию
$translit_surname = translitText($surname);//переводим фамилию в транслит для названия файла
$ready = $_POST["ready"];//ловим выполненные номера тестов
$readyar = preg_split("/[,]+/", $ready);//переводим их в массив
$readyar = array_values($readyar);//индексирует заново попорядку
$readyar_f = array_diff($readyar, array(''));
$count_readyar =  count($readyar_f);//кол-во отгаданных тестов


$try =$_POST["try"];//ловим количество попыток
$tryar = preg_split("/[,]+/", $try);//и их в массив
$tryar = array_values($tryar);//индексирует заново попорядку
$tryar_f = array_diff($tryar, array(''));
$result = array_count_values ($tryar_f);
$profit = $result[1];
$procent = ($profit/$count_readyar)*100;
$procent = round($procent, 0);
/*echo '<pre>';
print_r($count_readyar);
echo '<pre>';/*
echo '<pre>';
print_r($tryar_f);
echo '<pre>';
/*echo 'Всего Вы решили '.$count_readyar_true.' задачек! <br>';
echo 'c 1 попытки '.$result[1].' задачек решил <br>';
echo 'c 2 попыток '.$result[2].' задачек решил <br>';
echo 'c 3 попыток '.$result[3].' задачек решил <br>';
echo 'c 4 попыток '.$result[4].' задачек решил <br>';
echo 'c 5 попыток '.$result[5].' задачек решил <br>';
echo 'Ваш результат '.$procent.'%!';*/


$date = date("d.m.Y H-i");//устанавливаем дату
$myfile = fopen("stat/".$translit_surname."_".$translit_name.".txt","a");//создаем или открываем фаил с фамилией
fwrite($myfile,"\r\n".$date."___".$procent."% --". "Всего решено  ".$count_readyar."\r\n");
for($y = 0; $y < $count_readyar; $y++){
 fwrite($myfile, "Задание № ".$readyar_f[$y]." решил с ".$tryar_f[$y]." попыток! \r\n" );  
}
for($t = 1; $t <= 5; $t++){
fwrite($myfile, "c ".$t." попытки ".$result[$t]." задачек решил \r\n" );
}
fwrite($myfile, "\r\n __________________________________________________" );
fclose($myfile);

?>


    <div class="row static">
        <div class="col-1"></div>
        <div class="col forma">
            <h5><?php echo $name." ".$surname ?></h5>
            <h5><?php if ($procent >= 91){
                echo "Поздравляем Ваш результат <br><b>".$procent."%</b>!";
            }elseif($procent <= 90 && $procent >= 71){
                echo "Ваш результат <b>".$procent."%</b>!<br>"."Это неплохо, но стоит еще потренироваться!";
            }elseif($procent <= 70 && $procent >= 51){
                echo "Ваш результат <b>".$procent."%</b>.<br>"."Cтоит еще потренироваться.";
            }else{
                echo "Ваш результат <b>".$procent."%</b>!<br>"."Это никуда не годится. Повторите теорию и попробуйте ещё раз.";
            } ?></h5>
            <h6>Всего Вы решили <?php echo $count_readyar ?> заданий. <br>Из них с первой попытки <?php echo $profit ?>. </h6>

        </div>
        <div class="col-1"></div>
    </div>







<?php
function translitText($str) 
{
    $tr = array(
        "А"=>"A","Б"=>"B","В"=>"V","Г"=>"G",
        "Д"=>"D","Е"=>"E","Ё"=>"E","Ж"=>"J","З"=>"Z","И"=>"I",
        "Й"=>"Y","К"=>"K","Л"=>"L","М"=>"M","Н"=>"N",
        "О"=>"O","П"=>"P","Р"=>"R","С"=>"S","Т"=>"T",
        "У"=>"U","Ф"=>"F","Х"=>"H","Ц"=>"TS","Ч"=>"CH",
        "Ш"=>"SH","Щ"=>"SCH","Ъ"=>"","Ы"=>"YI","Ь"=>"",
        "Э"=>"E","Ю"=>"YU","Я"=>"YA","а"=>"a","б"=>"b",
        "в"=>"v","г"=>"g","д"=>"d","е"=>"e","ё"=>"e","ж"=>"j",
        "з"=>"z","и"=>"i","й"=>"y","к"=>"k","л"=>"l",
        "м"=>"m","н"=>"n","о"=>"o","п"=>"p","р"=>"r",
        "с"=>"s","т"=>"t","у"=>"u","ф"=>"f","х"=>"h",
        "ц"=>"ts","ч"=>"ch","ш"=>"sh","щ"=>"sch","ъ"=>"y",
        "ы"=>"yi","ь"=>"","э"=>"e","ю"=>"yu","я"=>"ya"
    );
    return strtr($str,$tr);
}
          ?>





   <div class="row final">
    
        <div class="col"><form action="index.php"><button  type="submit" class="btn btn-primary btn-lg btn-block">Попробовать еще</button></form>
        </div>
   
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