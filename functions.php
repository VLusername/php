<?php

/**************************TASK-1************************************************************/
function changeTime($time)
{
    if(preg_match("/^\s*([0-9]+)\s+мин.\s+([0-9]+)\s+сек.\s*$/", $time, $result)) {
        if ((int)$result[1] < 10) {
            $result[1] = "0" . $result[1];}
        return "minutes: " . $result[1] . "; seconds: " . $result[2] . "";} else{
        echo ('Неверный формат');}
}

/**************************TASK-3************************************************************/
function changeTimeZone($time)
{
    $timeZone = 'Europe/Madrid';
    $newTime = new DateTime($time);
    $newTime->setTimeZone(new DateTimeZone($timeZone));
    return "Время в Мадриде: ". $newTime->format('H:i');
}

/**************************TASK-4************************************************************/
function csvOperations($mysqli)
{
    $file = fopen("data.csv", "r");
    $csvData = fgetcsv($file, null, ";");
    $dataQuery = "CREATE TABLE IF NOT EXISTS csv (
                                                 `".$csvData[0]."` varchar(50) DEFAULT NULL,
                                                 `".$csvData[1]."` varchar(50) DEFAULT NULL,
                                                 `".$csvData[2]."` date DEFAULT NULL,
                                                 `".$csvData[3]."` datetime DEFAULT NULL,
                                                 `".$csvData[4]."` set('On', 'Off') DEFAULT NULL
                                                 )";
    $clearQuery = "TRUNCATE TABLE csv";
    if (!$mysqli->query($dataQuery)) {
        return "Create query error: ". $mysqli->error;
    } elseif (!$mysqli->query($clearQuery)) {
        return "Truncate query error: ". $mysqli->error;
    }else{
        while (($csvData = fgetcsv($file, null, ";")) !== false) {

            preg_match("/^\s*([0-9]{2})\.([0-9]{2})\.([0-9]{4})\s*$/", $csvData[2], $resultDate1);
            $csvData[2] = $resultDate1[3] . "-" . $resultDate1[2] . "-" . $resultDate1[1];
            preg_match("/^\s*([0-9]{2})\.([0-9]{2})\.([0-9]{4})\s+([0-9]+):([0-9]+)\s*$/", $csvData[3], $resultDate2);
            $csvData[3] = $resultDate2[3] . "-" . $resultDate2[2] . "-" . $resultDate2[1] . " " . $resultDate2[4] . ":" . $resultDate2[5] . ":00";

            $insertQuery = "INSERT INTO csv VALUES (
                                              '" . trim($csvData[0]) . "',
                                              '" . trim($csvData[1]) . "',
                                              '" . $csvData[2] . "',
                                              '" . $csvData[3] . "',
                                              '" . trim($csvData[4]) . "'
                                              )";
            if (!$mysqli->query($insertQuery)) {
                return "Insert query error: ". $mysqli->error;
            }
        }
    }
    fclose($file);
}

function csvFromTablePrint($mysqli)
{
    $getQuery = $mysqli->query("SELECT * FROM csv");
    $count = $mysqli->field_count;
    for ($i = 0; $i < $count; $i++) {
        echo(mysqli_fetch_field_direct($getQuery, $i)->name . "; ");
    }
    echo("<br>");
    while ($row = $getQuery->fetch_array()) {
        preg_match("/^\s*([0-9]{4})\-([0-9]{2})\-([0-9]{2})\s*$/", $row[2], $rowDate1);
        $row[2] = $rowDate1[3] . "." . $rowDate1[2] . "." . $rowDate1[1];
        preg_match("/^\s*([0-9]{4})\-([0-9]{2})\-([0-9]{2})\s+([0-9]+):([0-9]+):([0-9]+)\s*$/", $row[3], $rowDate2);
        $row[3] = $rowDate2[3] . "." . $rowDate2[2] . "." . $rowDate2[1] . " " . $rowDate2[4] . ":" . $rowDate2[5];
        for ($i = 0; $i < $count; $i++) {
            echo($row[$i] . "; ");
        }
        echo("<br>");
    }
}

/**************************TASK-5************************************************************/
function quine()
{
    echo '1st guine: ';
    $text = '$text = insert; echo preg_replace("/insert/m", "\n$text\n", $text, 1)'; echo preg_replace("/insert/m", "'\n$text\n'", $text, 1);
    echo '<br><br>2nd quine: ';
    $textForEdit = '$you can change this text (except dollar sign) and quine will consider changes'; $eval = 'printf ("%stextForEdit = \'%s\'; eval = %s; eval(%seval);", $textForEdit[0], $textForEdit, var_export($eval, true), $textForEdit[0]);'; eval($eval);

    /*$a = array(
        101,99,104,111,32,39,36,97,61,32,97,114,114,97,121,40,39,59,10,60,98,114,62,
        102,111,114,101,97,99,104,40,36,97,32,97,115,32,36,116,41,32,10,60,98,114,62,
        101,99,104,111,32,36,116,46,34,44,32,34,59,10,60,98,114,62,
        101,99,104,111,32,39,41,59,39,10,60,98,114,62,
        102,111,114,101,97,99,104,40,36,97,32,97,115,32,36,116,41,32,10,60,98,114,62,
        101,99,104,111,32,99,104,114,40,36,116,41,59
        );
    echo '$a = array(';
    foreach($a as $t)
        echo $t.", ";
    echo ');<br>';
    foreach($a as $t)
        echo chr($t);*/

}
/**************************TASK-6************************************************************/
function testStr($str, $ind){
    echo "Для рядка \$string[".$ind."] виконуються умови: ";
    preg_match_all("/(vol)/", $str, $result);
    if (count($result[0]) == 1) {
        echo("1, ");
    }
    preg_match_all("/(vol)/", $str, $result);
    if (count($result[0]) == 2) {
        echo("2, ");
    }
    preg_match_all("/(vol\s)/", $str, $result);
    if(count($result[0])) {
        echo("3, ");
    }
    preg_match_all("/^(vol)/", $str, $result);
    if(count($result[0])) {
        echo("4, ");
    }
    preg_match_all("/^(par)/", $str, $result);
    if(!count($result[0])) {
        echo("5, ");
    }
    echo "<br>";
}

function textParse($strings, $indexes)
{
    array_map("testStr", $strings, $indexes);
}

/**************************TASK-8************************************************************/
function checkEmail($email){
    preg_match("/^([a-zA-Z0-9.!#$%&'*+=?_-]{1,60})@([a-zA-Z]+.[a-zA-Z]{2,5})$/", $email, $result);
    if(count($result)) {
    //отримуємо МХ-записи (сервери, на які відправляється пошта) і їх пріорітети;
        $mx_res = getmxrr($result[2], $mx_records, $mx_weight);
        if($mx_res) {

            //записуємо ці сервери і пріорітети в один асоціативний масив, де ключами будуть сервери
            for($i = 0; $i < count($mx_records); $i++){
                $mxs[$mx_records[$i]] = $mx_weight[$i];
            }
            //сортуємо; найменше число - найвищий пріорітет
            asort ($mxs);

            //після сортування беремо тільки значення ключів (серверів)
            $records = array_keys($mxs);
            for($i = 0; $i < count($records); $i++){
                $fp = @fsockopen($records[$i], 25, $errno, $errstr, 2);
                if ($fp) {
                    echo "Connected to: " . $records[$i] . "<br>";

                    //представлення серверу
                    fwrite($fp, "HELO ". $_SERVER['HTTP_HOST']."\r\n");
                    echo fgets($fp). "<br>";
                    fwrite($fp, "MAIL FROM: <me@example.com>\r\n");
                    echo fgets($fp). "<br>";

                    //запит на відправку листа за адресою
                    fwrite($fp, "RCPT TO: <".$result[0].">\r\n");
                    echo fgets($fp) . "<br>";
                    $finalAnswer = "";
                    stream_set_timeout($fp, 1);
                    for ($j = 0; $j < 4; $j++) {
                        $finalAnswer .= fgets($fp);
                    }
                    echo $finalAnswer;
                    //аналіз відповіді по коду
                    if (substr($finalAnswer, 0, 3) == "250") {
                        echo "<br><br>Email '".$result[0]."' exist<br>";
                        fwrite($fp, "QUIT\r\n");
                        fclose($fp);
                        break;
                    } elseif (substr($finalAnswer, 0, 3) == "550") {
                        echo "<br><br>Email '".$result[0]."' doesn't exist at ".$records[$i]."<br><br>";
                        fwrite($fp, "QUIT\r\n");
                        fclose($fp);
                    }
                } else {
                    echo "<br>Connect error: " . $errstr;
                }
            }
        }
        else {
            echo "Connect to host error";
        }
    }
    else{
        echo "Invalid email format";
    }
}