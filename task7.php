<?php
include "header.php";
include "functions.php";

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
//перед записом інформації у змінні перевірка чи взагалі передавались дані з такими іменами<br>
//передвати таку інформацію рекомендують через $_POST, хоча можна і $_REQUEST :)<br>
    if (isset($_POST['login'])) $login = $_POST['login'];<br>
    if (isset($_POST['password'])) $password=$_POST['password'];<br><br>

//потім перевірка чи поля не порожні<br>
    if (empty($login) or empty($password)) { // повідомлення про помилку; закінчення роботи скрипта }<br><br>

//якщо не порожні, то обробляємо поля (екранування символів через \, перетворення спец символів і видалення пробілів) наприклад, для захисту від SQL-ін'єкцій<br>
    $login = stripslashes(htmlspecialchars(trim($login)));<br>
    $password = stripslashes(htmlspecialchars(trim($password)));<br><br>

//вважаємо, що підключення до БД налаштоване<br>
//робимо запит; змінюємо лапки на подвійні для всього запиту і одинарні для змінних<br>
    $res = mysql_query("SELECT id FROM users WHERE login='$login'",$db);<br><br>

//перевіряємо успішність виконання самого запиту<br>
    if($res == 'TRUE'){<br><br>
//якщо масив з результатом не пустий, то перевіряємо пароль, який для безпеки повинен зберігатися в БД не у чистому вигляді (а наприклад у вигляді хешу)<br>
//не розумію використання в прикладі list() для однієї змінної.. можливо для зберігання всіх даних про юзера в одній змінній, але тоді в сесію потрапить і пароль, що не є правильно<br>
    $row = mysql_fetch_array($res);<br>
    if (!empty($row['password'])) {<br>
        if($row['password'] == /*хеш-функція()*/($password)){<br>
            //зберігаємо значення логіна в сесії<br>
            session_start();<br>
            $_SESSION['authorized'] = $login; //або можна і $row['id']<br><br>
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