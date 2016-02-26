<?php
$mysqli = new mysqli("localhost", "root", "", "third_task_db");
if (mysqli_connect_errno()) {
    printf("Connection failed: %s\n", mysqli_connect_error());
    exit();
}
$mysqli->set_charset("utf8");