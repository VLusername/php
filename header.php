<?php
define('LEVEL1', '../level1/');
define('LEVEL2', '../level2/');
define('MAINFOLDER', '../');
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="<?=MAINFOLDER?>style.css" type="text/css" media="screen, projection" />
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
    <script src="<?=MAINFOLDER?>script.js"></script>
</head>
<body>
<div id="header">
    <ul>
        <a href="<?=MAINFOLDER?>index.php"><li>Главная</li></a>
        <a href="<?=MAINFOLDER?>level1.php"><li>Уровень 1</li></a>
        <a href="<?=MAINFOLDER?>level2.php"><li>Уровень 2</li></a>
    </ul>
</div>