<?php
declare(strict_types=1);

require_once 'vendor/autoload.php';

use App\Exception\FileFormatException;
use App\Exception\SourceFileException;
use App\Utils\CsvParser;
use App\Utils\SqlConvert;
use App\Utils\SqlWriter;

$rootCsvPath = './data/';
$sqlPath = './data/sql/';
$filePath = './data/categories.csv'; // для теста

$files = [];

foreach(glob($rootCsvPath.'*.csv') as $file) {
    $files[] = $file;
}

try {
    foreach ($files as $file) {
        $import = new CsvParser($file);
        $converter = new SqlConvert($import->getTableName(), $import->getData(), $import->getHeaderData());
        $createFile = new SqlWriter($import->getTableName(), $sqlPath);
        $createFile->write($converter->createStatement());

        echo $import->getTableName() . ' -- создан';
        echo '<br>';
    }
} catch (SourceFileException $error) {
    echo 'Ошибка: ' . $error->getMessage();
} catch (FileFormatException $error) {
    echo 'Ошибка: ' . $error->getMessage();
}


function dump($var)
{
    echo '<pre>';
    var_dump($var);
    echo '</pre>';
}
