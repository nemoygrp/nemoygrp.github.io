   <?php

# подключаем библиотеку
   require_once "$_SERVER[DOCUMENT_ROOT]/PHPExcel/Classes/PHPExcel.php";
# Указываем путь до файла .xlsx
   $File = "$_SERVER[DOCUMENT_ROOT]/test_1_vopros.xlsx";

   $Excel = PHPExcel_IOFactory::load($File);

//Определяем интервал имеющихся тестов
   $numbers = array();
   for($z = 1; $z < 1000; $z++){

       $value = $Excel->getActiveSheet()->getCell('A'.$z)->getValue();
       if($value != null){
           $numbers[] = $value;
       }
}//определяем длину массива с номерами тестов
$count_numbers = count($numbers);
//определяем какие номера тестов уже выбыли


$new_numbers = array_diff($numbers,$readyar);//вычитаем из 1 второй массив
$new_numbers = array_values($new_numbers);//делаем все ключи цифрами и попорядку

$new_numbers_without = array_diff($new_numbers,$numbers_today);//вычитаем из 1 второй массив
$new_numbers_without = array_values($new_numbers_without);//делаем все ключи цифрами и попорядку

  $i = rand(reset($new_numbers_without),end($new_numbers_without));//вводим переменную счетчик

//проверяем наличие значения в нужном нам массиве, и если найдем то рандомим снова пока не попадется отсутствующее, либо при пустом массиве закрываем цикл
  while(true){
     if(in_array($i,$new_numbers_without)){
        break;
    }elseif (empty($new_numbers_without)) {
       break;
   } else{
    $i = rand(reset($new_numbers_without),end($new_numbers_without));
    continue;
}

}


$numbers_today[] = $i;//добавляем номер в список, чтобы тесты не повторялись в рамках 1 страницы

//Наполняем содержимое из экселя
$test = array($Excel->getActiveSheet()->getCell('A'.$i )->getValue(),
    $Excel->getActiveSheet()->getCell('B'.$i )->getValue(),
    $Excel->getActiveSheet()->getCell('C'.$i )->getValue(),
    $Excel->getActiveSheet()->getCell('D'.$i )->getValue(),
    $Excel->getActiveSheet()->getCell('E'.$i )->getValue(),
    $Excel->getActiveSheet()->getCell('F'.$i )->getValue(),
    $Excel->getActiveSheet()->getCell('G'.$i )->getValue(),
    $Excel->getActiveSheet()->getCell('H'.$i )->getValue(),
    $Excel->getActiveSheet()->getCell('I'.$i )->getValue(), );

    ?>



    <div class="lesson" id="lesson<?php echo "_$i"?>">
        <div class="row test">
            <div class="col test">
                <p>#<span id="number_test<?php echo "_$i"?>"><?php echo $test['0'] ?></span></p>
                <h6 id="text_test<?php echo "_$i"?>"><?php echo $test['1'] ?></h6>
            </div>
        </div>

        <div class="row answers" id="box">

            <div class="col-1 form-check form-check-inline">
                <input class="form-check-input" type="checkbox" id="inlineCheckbox1<?php echo "_$i"?>" value="option1">
                <label class="form-check-label" for="inlineCheckbox1"><?php echo $test['2'] ?></label>
            </div>
            <div class="col-1 form-check form-check-inline">
                <input class="form-check-input" type="checkbox" id="inlineCheckbox2<?php echo "_$i"?>" value="option2">
                <label class="form-check-label" for="inlineCheckbox2"><?php echo $test['3'] ?></label>
            </div>
            <div class="col-1 form-check form-check-inline">
                <input class="form-check-input" type="checkbox" id="inlineCheckbox3<?php echo "_$i"?>" value="option3">
                <label class="form-check-label" for="inlineCheckbox3"><?php echo $test['4'] ?></label>
            </div>
            <div class="col-1 form-check form-check-inline">
                <input class="form-check-input" type="checkbox" id="inlineCheckbox4<?php echo "_$i"?>" value="option4">
                <label class="form-check-label" for="inlineCheckbox4"><?php echo $test['5'] ?></label>
            </div>
            <div class="col-1 form-check form-check-inline">
                <input class="form-check-input" type="checkbox" id="inlineCheckbox5<?php echo "_$i"?>" value="option5">
                <label class="form-check-label" for="inlineCheckbox5"><?php echo $test['6'] ?></label>
            </div>
            <div class="col" id="answer_conf<?php echo "_$i"?>" style="margin-bottom: 10px;margin-top: 10px;">
                <button type="button" id="answer_button<?php echo "_$i"?>" class="btn btn-outline-success" style="float: right;" onclick="check(<?php echo "$i"?>,<?php echo $test['8']?>,<?php echo $test['7'] ?>); return false;">Ответить</button>
            </div>

        </div>
    </div>
