<?php
include "header.php";
include "functions.php";

echo ("<div id='content'>
    <div>Задача 8. Написать php-функцию, определяющую, существует ли введенный посетителем email-адрес в действительности. Критичными являются: время ожидания ответа, достоверность ответа.<br><br><br><br>
    ");

getmxrr("gmail.com", $mx_records, $mx_weight);


for($i = 0; $i < count($mx_records); $i++){
    echo $mx_weight[$i]."<br>";
    $mxs[$mx_records[$i]] = $mx_weight[$i];
}

asort ($mxs);


$records = array_keys($mxs);

for($i = 0; $i < count($records); $i++){
    echo $records[$i];
    echo '<br>';
    $fp = @fsockopen("www.example.com", 80, $errno, $errstr, 2);
    if($fp) {
        echo "<br>ok";

        fclose($fp);
    }else echo "<br>bad - ".$errstr." --- ".$errno;
}


echo ("</div>
    </div>
    </body>
    </html>");