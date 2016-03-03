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
/**************************TASK-4************************************************************/
/**
 * Функція пошуку інформації у html-сторінці
 * @return void
 */
function findInHTML()
{
    $code = file_get_contents('http://www.bills.ru');
    $doc = new DomDocument('1.0', 'utf-8');
    $doc->loadHTML($code);
    $xp = new DomXPath($doc);

    $str = "";
    $count = 0;
    foreach ($xp->query('//*[@id="bizon_api_news_list"]/tr/td') as $node) {
        $str .= $node->nodeValue . "<br>";
        $count++;
        if ($count === 10) {
            break;
        }
    };

    $href = "";
    $count = 0;
    foreach ($xp->query('//*[@id="bizon_api_news_list"]/tr/td/a') as $node) {
        $href .= $node->getAttribute('href') . "<br>";
        $count++;
        if ($count === 5) {
            break;
        }
    };
    echo "<br>" . $str;
    echo "<br>" . $href;
}