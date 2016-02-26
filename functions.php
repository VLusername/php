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
    $a = array(
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
        echo chr($t);

}