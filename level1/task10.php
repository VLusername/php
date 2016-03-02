<?php
include "../header.php";

echo("<div id='content'>
    <div>
    Задача 10. Что выведеться на экран:<br><br>");

?>
    class main {<br>
        private $activated;<br>
        function __construct(){ $this->set_activated();}<br><br>

        function set_activated(){<br>
            $this->activated = '$$$';<br>
        }<br>
        function show_main(){<br>
            if (isset($this->activated)){<br>
                echo 'your content main';<br>
            }<br>
        }<br>
    }<br><br>

    class testing extends main{<br>
    function __construct(){ parent:: __construct();}<br>
    function show_testing(){<br>
    if (isset($this->activated)){<br>
    echo 'your content testing';<br>
    }<br>
    }<br>
    }<br><br>

<?php

echo "<br><br>Виведе лише ось це:<br>your content main<br>-------------------<br><br>
тому що конструкція в похідному класі isset(\$this->activated) не пройде перевірку, не буде доступу<br><br>";

echo "Щоб вивело і інший рядок можна додати в батьківський клас функцію:<br>";
?>

    function get_activated(){<br>
    return $this->activated;<br>
    }<br>
<?php
echo "і в похідному класі робити перевірку типу такої:<br>";?>
    $t = parent::get_activated();<br>
    if (isset($t)){<br>
    echo 'your content testing';<br>
    }<br><br>Або просто змінити специфікатор доступу на public
<?php
echo ("</div>
    </div>
    </body>
    </html>");