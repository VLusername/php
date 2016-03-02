<?php

final class init {

    private $mysqli;

    public function __construct() {
        $this->mysqli = new mysqli("localhost", "root", "", "third_task_db");
        if (mysqli_connect_errno()) {
            printf("Connection failed: %s\n", mysqli_connect_error());
            exit();
        }else $this->mysqli->set_charset("utf8");
        $this->create();
        $this->fill();
    }

    private function create(){
        $createQuery = "CREATE TABLE IF NOT EXISTS test (
                                                 `id` int(5) AUTO_INCREMENT PRIMARY KEY,
                                                 `script_name` varchar(25) DEFAULT NULL,
                                                 `start_time` int DEFAULT NULL,
                                                 `end_time` int DEFAULT NULL,
                                                 `result` set('normal', 'illegal', 'failed', 'success') DEFAULT NULL
                                                 )";
        try{
            if (!$this->mysqli->query($createQuery)) {
                throw new Exception('Не удалось создать таблицу - '.$this->mysqli->error);
            }else{
                echo 'Таблица test создана';
            }
        }catch (Exception $e) {
            echo '<br>Исключение: ',  $e->getMessage(), "\n";
        }

    }
    private function fill(){
        $setArray = array('normal', 'illegal', 'failed', 'success');
        try{
            $this->mysqli->query("TRUNCATE TABLE `test`");
            for($i = 0; $i < 10; $i++) {
                $fillQuery = "INSERT INTO `test` (`script_name`, `start_time`, `end_time`, `result`) VALUES ('".rand(1, 10)."', '".rand(1, 10)."', '".rand(1, 10)."', '".$setArray[rand(0, 3)]."')";
                if (!$this->mysqli->query($fillQuery)) {
                    throw new Exception('Не удалось записать данные в таблицу - ' . $this->mysqli->error);
                } else {
                    //echo "<br>".$i."-я строка данных добавлена в таблица test";
                }
            }
        }catch (Exception $e) {
            echo '<br>Исключение: ',  $e->getMessage(), "\n";
        }
    }
    public function get(){
        $selectQuery = "SELECT * FROM `test` WHERE `result` = 'normal' OR `result` = 'success'";
        try{
            if (!$result = $this->mysqli->query($selectQuery)) {
                throw new Exception('Не удалось извлекти данные из таблицы - '.$this->mysqli->error);
            }else{
                while($row = $result->fetch_assoc()){
                    echo "<br>".$row['id']." | ".$row['script_name']." | ".$row['start_time']." | ".$row['end_time']." | ".$row['result']."";
                }
            }
        }catch (Exception $e) {
            echo '<br>Исключение: ',  $e->getMessage(), "\n";
        }
    }
}
