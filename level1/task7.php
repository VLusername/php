<?php
include "../header.php";
include "../functions.php";

echo ("<div id='content'>
    <div>
    ");
?>
Задача 7. Есть скрипт:<br><br>

$login = $_REQUEST['login'];<br>
$password = $_REQUEST['password'];<br>
$res = mysql_query('SELECT id FROM users<br>
WHERE login="'.$login.'" AND password="'.$password.'"');<br>
list($user_id) = mysql_fetch_array($res);<br>
session_start();<br>
$_SESSION['authorized'] = isset($user_id);<br><br>

Есть ли тут проблемы с безопасностью? И если да, то как обезопасить этот скрипт.<br><br>

Мій варіант:<br>
//запуск сесії<br>
    session_start();<br>
//перед записом інформації у змінні перевірка чи взагалі передавались дані з такими іменами<br>
//передвати таку інформацію рекомендують через $_POST, хоча можна і $_REQUEST :)<br>
    if (isset($_POST['login'])) $login = $_POST['login'];<br>
    if (isset($_POST['password'])) $password=$_POST['password'];<br><br>

//потім перевірка чи поля не порожні<br>
    if (empty($login) or empty($password)) { // повідомлення про помилку; закінчення роботи скрипта }<br><br>

//пропоную так<br>
    $login = mysqli_real_escape_string(htmlspecialchars(trim($login)));<br>
    $password = mysqli_real_escape_string(htmlspecialchars(trim($password)));<br><br>

//вважаємо, що підключення до БД налаштоване через об'єкт $mysqli, тоді<br>
//робимо запит; змінюємо лапки на подвійні для всього запиту і одинарні для змінних<br>
    $res = $mysqli->query("SELECT `id` FROM `users` WHERE `login` = '$login'");<br><br>

//перевіряємо успішність виконання самого запиту<br>
    if($res == 'TRUE'){<br><br>

    //якщо масив з результатом не пустий, то перевіряємо пароль (я використовував станлартну функцію md5)<br>
//відповідно значення паролю в БД має бути захешоване<br>
    //fetch_array() використовую один раз без циклу бо приймаю, що значення шуканого id може бути лише одне або не бути зовсім
    $row = $res->fetch_array();<br>
    if (!empty($row['password'])) {<br>
        if($row['password'] == md5($password)){<br>
            //зберігаємо значення логіна в сесії<br>
            $_SESSION['login'] = $login;<br><br>
            //повідомлення про успішу авторизацію<br>
        }else{//помилка логіну або паролю}<br>
    }<br>
    else{//помилка логіну або паролю}<br>
    }else{//помилка запиту}<br><br>
<?php
echo ("</div>
    </div>
    </body>
    </html>");
?>