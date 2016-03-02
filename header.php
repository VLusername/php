<?php
define('LEVEL1', '../level1/');
define('LEVEL2', '../level2/');
define('MAINFOLDER', '../');
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="<?=MAINFOLDER?>style.css" type="text/css" media="screen, projection" />
</head>
<body>
<div id="header">
    <ul>
        <a href="<?=MAINFOLDER?>index.php"><li>Главная</li></a>
        <a href="<?=MAINFOLDER?>level1.php"><li>Уровень 1</li></a>
        <a href="<?=MAINFOLDER?>level2.php"><li>Уровень 2</li></a>
        <a href="<?=MAINFOLDER?>level3.php"><li>Уровень 3</li></a>
    </ul>
</div>