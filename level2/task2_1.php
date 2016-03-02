<?php
include "../header.php";
include "../classes.php";

echo ("<div id='content'>
    <div>
    Задача 1. Написать класс init<br><br>");

$init = new init();
$init->get();

echo ("</div>
    </div>
    </body>
    </html>");