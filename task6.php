<?php
include "header.php";
include "functions.php";

echo ("<div id='content'>
    <div>
    Задача 6. Есть текстовый массив:<br>");
?>
$string[1]=’revolution vol 1’;<br>
$string[6]=’revolution part 2’;<br>
$string[10]=’revolution apart for volume 3’;<br><br>

Вывести на экран:<br>
1) индекс элемента массива в котором присутсвует «vol» только один раз<br>
2) индекс элемента массива в котором присутсвует «vol» 2 раза<br>
3) индекс элемента массива в котором присутсвует «vol» и до и после этого слова стоит пробел<br>
4) индекс элемента массива в котором присутсвует «vol» в начале строки<br>
5) индекс элемента массива в котором не присутсвует «par» в начале строки<br>
Внимание: нельзя использовать цикл FOR<br><br>

<?php

$string[1] = 'revolution vol 1';
$string[6] = 'revolution part 2';
$string[10] = 'revolution apart for volume 3';
$indexes = array_keys($string);

textParse($string, $indexes);

echo ("</div>
    </div>
    </body>
    </html>");