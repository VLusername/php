<?php
/**
 * Файл реалізації класів
 *
 * @author Viacheslav <viacheslav.mail@gmail.com>
 * @version 1.0
 */

/**
 * Клас для створення й заповнення таблиці для завдання 1
 */
final class init {

    /**
     * Змінна для з'єднання з БД типу об'єкта mysqli
     * @access private
     * @var mysqli
     */
    private $mysqli;

     /**
      * Констурктор класу
      * @uses init::$mysqli для підключення до БД
      * @uses init::create() створення таблиці
      * @uses init::fill() заповнення таблиці випадковими значеннями
      * @return void
     */
    public function __construct() {
        $this->mysqli = new mysqli("localhost", "root", "", "third_task_db");
        if (mysqli_connect_errno()) {
            printf("Connection failed: %s\n", mysqli_connect_error());
            exit();
        }else $this->mysqli->set_charset("utf8");
        $this->create();
        $this->fill();
    }

    /**
     * Метод створення таблиці
     * @uses init::$mysqli для підключення до БД
     * @return void
     */
    private function create(){

        /**
         *
         * @param string $createQuery змінна зберігання запиту створення таблиці
         */
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
    /**
     * Метод заповнення таблиці
     * @uses init::$mysqli для підключення до БД
     * @return void
     */
    private function fill(){
        /**
         * @param array $setArray масив для зберігання варіантів заповнення поля таблиці result
         */
        $setArray = array('normal', 'illegal', 'failed', 'success');
        try{
            $this->mysqli->query("TRUNCATE TABLE `test`");
            for($i = 0; $i < 10; $i++) {
                /**
                 * @param string $fillQuery змінна зберігання запиту вставки
                 */
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

    /**
     * Метод вибірки з таблиці
     * @uses init::$mysqli для підключення до БД
     * @return void
     */
    public function get(){
        /**
         *
         * @param string $selectQuery змінна зберігання запиту вибірки
         */
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
