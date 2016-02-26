<?php
include "header.php";
include "functions.php";

echo("<div id='content'>
    <div>
    Задача 2. Написать php-функцию определения московского времени, не зависимо от серверного времени (нельзя использовать date_default_timezone_set)<br><br>
    <form action='' method='post'>
        <label>Текущее время: </label><br><input type='text' name='time' size='30' value='".date("H:i")."'/><br><br>
        Текущая временная зона: ".date_default_timezone_get()."<br><br>
        <input type='submit' value='Определить время в Мадриде' ><br>
    </form><br>");
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    if($_POST['time'] != '' && preg_match("/^([0-1][0-9]|[2][0-3]):([0-5][0-9])$/", $_POST['time'])){
        echo(changeTimeZone($_POST['time']));} else{
        echo('Неверный формат времени');}
    }
echo ("</div>
    </div>
    </body>
    </html>");