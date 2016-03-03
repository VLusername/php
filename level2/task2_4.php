<?php
include "../header.php";
include "../functions_level2.php";

echo ("<div id='content'>
    <div>
        Задача 6. Написать скрипт закачивания страницы www.bills.ru, из страницы извлечь даты, заголовки, ссылки в блоке \"события на долговом рынке\", сохранить в таблицу bills_ru_events<br><br>");
findInHTML();
echo ("</div>
        </div>
        </body>
        </html>");