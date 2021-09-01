<?php

declare(strict_types=1);

ini_set('display_errors', 'On');
error_reporting(E_ALL);
use academy\utils\DataImporterSpl;
use academy\exceptions\FileFormatException;
use academy\exceptions\SourceFileException;

require_once 'vendor/autoload.php';

$loader = new DataImporterSpl('data/users.csv', ['creation_time','name','password','email']);

$records = [];

try {
    $loader->import();
    $records = $loader->getData();
}
catch (SourceFileException $e) {
    error_log("Не удалось обработать csv файл: " . $e->getMessage());
}
catch (FileFormatException $e) {
    error_log("Неверная форма файла импорта: " . $e->getMessage());
}

//var_dump($records);
print_r($loader);

?>