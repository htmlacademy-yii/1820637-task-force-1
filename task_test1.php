<!DOCTYPE html><html><meta charset='utf-8'>

<?php

use academy\ex\StatusExistException;
use academy\ex\ActionExistException;

require_once 'vendor/autoload.php';

$case = new academy\strategy\Task ('new', 0, 1, 0); // $status, $userId, $ownerId, $workerId

// вывод текущего статуса
echo $case->getStatus()."<br><br>";

// список статусов и действий массивом
print_r($case->getCodesMap());
echo "<br><br>";

// Новый статус
echo $case->getNextStatus('finish')."<br><br>";

// список действий в данном статусе - массив
print_r($case->getActionInStatus());

?>
