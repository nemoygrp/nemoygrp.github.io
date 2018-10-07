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
       
        var popitka = 1;
        function check(num,a1,a2){  
            var an1 = a1 - 1;
            var an2 = a2 - 1;
            var answers = [document.getElementById("inlineCheckbox1_"+ num).checked,
            document.getElementById("inlineCheckbox2_"+ num).checked,
            document.getElementById("inlineCheckbox3_"+ num).checked,
            document.getElementById("inlineCheckbox4_"+ num).checked,
            document.getElementById("inlineCheckbox5_"+ num).checked];
            var count = 0;
            for(var b = 0; b < answers.length; b++){
                if(answers[b] == true){
                    count++;
                }
            }
            if(count == 2){
                if(answers[an1] == true && answers[an2] == true){
                  document.getElementById("lesson_"+num).style.background ="#C7FFD4";
                  document.getElementById("answer_button_"+num).className = "btn btn-outline-success";
                  document.getElementById("answer_button_"+num).innerHTML = "Верно!";
                  stat(num,true);
                  switch (popitka) {
                    case 1:
                    document.getElementById("negat").innerHTML += "1"+ ",";
                    document.getElementById("negat_2").innerHTML += "1"+ ",";
                    break;
                    case 2:
                    document.getElementById("negat").innerHTML += "2"+ ",";
                    document.getElementById("negat_2").innerHTML += "2"+ ",";
                    break;
                    case 3:
                    document.getElementById("negat").innerHTML += "3"+ ",";
                    document.getElementById("negat_2").innerHTML += "3"+ ",";
                    break;
                    case 4:
                    document.getElementById("negat").innerHTML += "4"+ ",";
                    document.getElementById("negat_2").innerHTML += "4"+ ",";
                    break;
                    case 5:
                    document.getElementById("negat").innerHTML += "5"+ ",";
                    document.getElementById("negat_2").innerHTML += "5"+ ",";
                    break;
                    default:
                    document.getElementById("negat").innerHTML += ">5+" + ",";
                    document.getElementById("negat_2").innerHTML += ">5+" + ",";

                }
                popitka = 1

            }else{
                document.getElementById("inlineCheckbox1_"+ num).checked = false;
                document.getElementById("inlineCheckbox2_"+ num).checked = false;
                document.getElementById("inlineCheckbox3_"+ num).checked = false;
                document.getElementById("inlineCheckbox4_"+ num).checked = false;
                document.getElementById("inlineCheckbox5_"+ num).checked = false;
                document.getElementById("lesson_"+num).style.background ="#FFA1A1";
                document.getElementById("answer_button_"+num).className = "btn btn-outline-danger";
                document.getElementById("answer_button_"+num).innerHTML = "Еще раз";
                popitka++;   
            }

        }else{
            alert("Нужно выбрать 2 варианта!!!");
        }
    }      
    function stat(number,value){
        if(value == true)
            document.getElementById("stat").innerHTML += number + ",";
            document.getElementById("stat_2").innerHTML += number + ",";
    }
    
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
$name = $_POST["name"];
$surname = $_POST["surname"];
$ready = $_POST["ready"];

$readyar = preg_split("/[,]+/", $ready);
$try = $_POST["try"];

$numbers_today = array();
$new_numbers = array();

for ($n = 0; $n < 3; $n++){
    include('test.php');
    if (empty($new_numbers_without[1])){
        echo '<style> #btn_more{ display:none;}</style>';
        break;
    }

} 

          ?>




    <div class="row statistic">
        <div class="col stat">
            <form method="post" action="tests.php" id="more">
            <textarea type="text" name="name"><?php echo $name; ?></textarea>
            <textarea type="text" name="surname"><?php echo $surname; ?></textarea>
            <textarea id="stat" type="text" name="ready"><?php echo $ready; ?></textarea>
            <textarea id="negat" type="text" name="try"><?php echo $try; ?></textarea>
            </form>
        </div>
    </div>

        <div class="row statistic">
            <div class="col"><button form="more" type="submit" class="btn btn-primary btn-lg btn-block" id="btn_more">Продолжить</button>
            </div>
            
        </div>
  
    <div class="row final">
       <div class="col stat">
        <form method="post" action="statistics.php" id="enought">
           <textarea type="text" name="name"><?php echo $name; ?></textarea>
           <textarea type="text" name="surname"><?php echo $surname; ?></textarea>
           <textarea id="stat_2" type="text" name="ready"><?php echo $ready; ?></textarea>
           <textarea id="negat_2" type="text" name="try"><?php echo $try; ?></textarea>
           </form>
       </div>
   </div>
   <div class="row final">
        <div class="col"><button form="enought" type="submit" class="btn btn-primary btn-lg btn-block" id="btn_enougth">Завершить</button>
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