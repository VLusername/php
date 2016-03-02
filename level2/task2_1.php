<?php
/**
 * Файл першого завдання другого рівня
 *
 * @author Viacheslav <viacheslav.mail@gmail.com>
 * @version 1.0
 */

/**
 * Підключеня файлу заголовку сторінки
 */
include "../header.php";
/**
 * Підключеня файлу з реалізацією класів
 */
include "../classes.php";

echo ("<div id='content'>
    <div>
    Задача 1. Написать класс init<br><br>");

/**
 * Ініціалізація класу
 */
$init = new init();
$init->get();

echo ("</div>
    </div>
    </body>
    </html>");