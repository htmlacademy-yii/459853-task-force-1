<?php
declare(strict_types=1);

require_once 'vendor/autoload.php';
use \App\Controllers\Exception\SourceFileException;
use \App\Controllers\Exception\FileFormatException;
use App\Controllers\Utils\CsvParser;

$import = new CsvParser('./data/categories.csv');


try {
    $import->parse();
    dump($import->getData());
} catch(SourceFileException $error) {
    echo 'Ошибка: ' . $error->getMessage();
} catch(FileFormatException $error) {
    echo 'Ошибка: ' . $error->getMessage();
}



function dump ($var) {
    echo '<pre>';
        var_dump($var);
    echo '</pre>';
}
