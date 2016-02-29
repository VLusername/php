<?php
include "header.php";
include "functions.php";

echo ("<div id='content'>
    <div>Задача 8. Написать php-функцию, определяющую, существует ли введенный посетителем email-адрес в действительности. Критичными являются: время ожидания ответа, достоверность ответа.<br><br>
    <form action='' method='post'>
         <label>Email: </label><br><input type='text' name='email' size='30' placeholder='Enter your email'/><br><br>
         <input type='submit' value='Check it' ><br>
    </form><br>");
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    checkEmail($_POST['email']);
    }
echo ("</div>
    </div>
    </body>
    </html>");