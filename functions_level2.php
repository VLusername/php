<?php
/**
 * Файл з функціями для завдань другого рівня
 *
 * @author Viacheslav <viacheslav.mail@gmail.com>
 * @version 1.0
 */


/**************************TASK-3************************************************************/
/**
 * Функція пошуку файлів в каталозі
 * @return void
 */
function findFiles()
{
    /**
     *
     * @param [дескриптор] $handle для пошуку в ньому імен файлів
     * @param array $files масив для зберігання всіх файлів каталогу
     */
    if ($handle = opendir('../datafiles')) {
        $files = array();
        while (false !== ($file = readdir($handle))) {
            preg_match("/^[a-zA-Z0-9]+.ixt$/", $file, $result);
            if (count($result[0])) {
                array_push($files, $file);
            }
        }
        asort($files);
        echo "Файлы:<br>";
        foreach ($files as $file) {
            echo $file . "<br>";
        }
        closedir($handle);
    }
}