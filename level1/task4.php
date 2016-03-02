<?php
include "../header.php";
include "../functions.php";
include "../connect.php";

echo("<div id='content'>
    <div>
    Задача 4. Существует CSV-файл. Требуется создать скрипт на языке PHP, который должен:<br>
            1. Создать MySQL таблицу под данную структуру файла.<br>
            2. Все данные из CSV-файла экспортировать в созданную таблицу.<br>
            3. Вывести данные на экран из базы данных в том же виде, в каком они были получены из CSV-файла.<br><br>
    ");
echo csvOperations($mysqli);
csvFromTablePrint($mysqli);
echo ("</div>
    </div>
    </body>
    </html>");