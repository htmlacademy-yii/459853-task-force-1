<?php
declare(strict_types=1);

require_once 'vendor/autoload.php';

use App\Controllers\Exception\FileFormatException;
use App\Controllers\Exception\SourceFileException;
use App\Controllers\Utils\CsvParser;
use App\Controllers\Utils\SqlConvert;
use App\Controllers\Utils\SqlWriter;

$rootCsvPath = './data/';
$sqlPath = './data/sql/';
$filePath = './data/categories.csv'; // для теста


$files = array_filter(scandir($rootCsvPath), function ($item) {
    $info = new SplFileInfo($item);
    if ($info->getExtension() === 'csv') {
        return $item;
    }
});

try {
    foreach ($files as $file) {
        $import = new CsvParser($rootCsvPath . $file);
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
