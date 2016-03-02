<?php
include "header.php";

echo ("<div id='content'>
    <div>
    ");
?>
Задача 9. Есть скрипт:<br><br>

    $login=’pravilnij login’;<br>
    $pass= ’pravilnij parol’;<br>
    if ($_REQUEST['login']<>$login or $_REQUEST['pass']<>$pass){<br>
    echo 'you are not allowed to visit this page!';<br>
    } else {<br>
    // sensible content<br>
    echo 'sensible content';<br>
    }<br>
    …<br>
    Вопрос: какие проблемы с этим кодом? Как его исправить чтобы проблем не было?<br><br>


Мій варіант:<br>
//якщо прийняти, що пароль і логін опрацьовані і захищені від некоректних чи шкідливих значень,<br>
//то я бачу тут одну головну помилку - порівняння через оператор "<>".<br>
//перед порівнянням цей оператор перетворює типи.<br>
//тоді, наприклад, логін у вигляді рядка "1234" може стати числом і відповідно далі все буде некоректно..<br><br>

//тому для даного прикладу необхідно змінить оператор на "!==" або "==="<br>
//в останньому випадку треба поміняти місцями опрацювання умов:<br><br>

    if ($_REQUEST['login'] === $login or $_REQUEST['pass'] === $pass){<br>
    // sensible content<br>
    echo 'sensible content';<br>
    } else {<br>
    echo 'you are not allowed to visit this page!';<br>
    }<br>

<?php
echo ("</div>
    </div>
    </body>
    </html>");
?>