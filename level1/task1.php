<?php
include "../header.php";
include "../functions.php";

echo ("<div id='content'>
    <div>
    Задача 1. Написать php-функцию, которая получает строку вида '5 мин. 35 сек.', а возвращает строку вида 'minutes: 05; seconds: 35'<br><br>
    <form action='' method='post'>
         <label>Время: </label><br><input type='text' name='time' size='30' value='5 мин. 35 сек.'/><br><br>
         <input type='submit' value='Изменить' ><br>
    </form><br>");
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    echo changeTime($_POST['time']);
    }
echo ("</div>
    </div>
    </body>
    </html>");