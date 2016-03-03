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
     * @param array $files масив для зберігання знайдених файлів каталогу
     */
    $files = array();
    $it = new FilesystemIterator('../datafiles');
    foreach ($it as $fileinfo) {
        preg_match("/^[a-zA-Z0-9]+.ixt$/", $fileinfo->getFilename(), $result);
        if (count($result[0])) {
            array_push($files, $fileinfo->getFilename());
        }
    }
    asort($files);
    echo "Файлы:<br>";
    foreach ($files as $file) {
        echo $file . "<br>";
    }
}