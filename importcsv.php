<?php
declare(strict_types=1);

require_once 'vendor/autoload.php';
use \App\Controllers\Exception\SourceFileException;
use \App\Controllers\Exception\FileFormatException;
use App\Controllers\Utils\CsvParser;
use App\Controllers\Utils\SqlConvert;


try {
    $import = new CsvParser('./data/categories.csv');
    $import->parse();

    $converter = new SqlConvert($import->getData());
    $converter->convert();

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
