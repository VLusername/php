<?php
include "header.php";
include "functions.php";

echo ("<div id='content'>
    <div>Задача 8. Написать php-функцию, определяющую, существует ли введенный посетителем email-адрес в действительности. Критичными являются: время ожидания ответа, достоверность ответа.<br><br>
    ");
checkEmail();
echo ("</div>
    </div>
    </body>
    </html>");