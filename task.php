<?php

class Task
{

// Конструктор с обоими id

public function __construct($id_owner, $id_worker)
{
        $this->id_owner = $id_owner;
        $this->id_worker = $id_worker;
}

// Переменные статуса и действия

public $status;
public $action;


// Функция возврата статуса

public function getStatus() {
        return $this->status;
    }



// Статусы

const STATUS_NEW = 'Новое';
const STATUS_CANCEL = 'Отменено';
const STATUS_WORK = 'В работе';
const STATUS_DEAD = 'Провалено';
const STATUS_DONE = 'Выполнено';

// Действия заказчика

const ACTION_NEW = 'Добавить';
const ACTION_CANCEL = 'Отменить';
const ACTION_WORK = 'Принять';
const ACTION_DEAD = 'Заявить о проблеме';
const ACTION_DONE = 'Завершить';

// Действия исполнителя

const ACTION_APPLY = 'Откликнуться';
const ACTION_STRIKE = 'Отказаться';



// Вывод списка возможных статусов и действий

public function listStatus() {

$status = array("STATUS_NEW" => 'Новое',
"STATUS_CANCEL" => 'Отменено',
"STATUS_WORK" => 'В работе',
"STATUS_DEAD" => 'Провалено',
"STATUS_DONE" => 'Выполнено');

$action = array("ACTION_NEW" => 'Добавить',
"ACTION_CANCEL" => 'Отменить',
"ACTION_WORK" => 'Принять',
"ACTION_DEAD" => 'Заявить о проблеме',
"ACTION_DONE" => 'Завершить',
"ACTION_APPLY" => 'Откликнуться';
"ACTION_STRIKE" => 'Отказаться');

echo "Статусы\n\n";
foreach($status as $key => $value){
    echo $key."\t=>\t".$value."\n";
}

echo "\nДействия\n\n";
foreach($action as $key => $value){
    echo $key."\t=>\t".$value."\n";
}
}



// Вывод на печать правил перехода ("Откликнуться" не меняет статус)

public function getNextStatus() {

$actionToStatus = array("ACTION_NEW" => 'STATUS_NEW',
"ACTION_CANCEL" => 'STATUS_CANCEL',
"ACTION_WORK" => 'STATUS_WORK',
"ACTION_DEAD" => 'STATUS_DEAD',
"ACTION_DONE" => 'STATUS_DONE',
"ACTION_APPLY" => 'STATUS_NEW',
"ACTION_STRIKE" => 'STATUS_DEAD');

echo "Статус после действия\n\n";
foreach( $actionToStatus as $key => $value ){
    echo $key."\t=>\t".$value."\n";
}
}


// Вывод на печать возможных действий в статусе

public function actionInStatus() {

if ($this->status == STATUS_NEW) $actionInStatus = array('ACTION_CANCEL', 'ACTION_APPLY', 'ACTION_WORK');
elseif ($this->status == STATUS_WORK) $actionInStatus = array ('ACTION_DONE', 'ACTION_APPLY', 'ACTION_STRIKE');
else $actionInStatus = array ('Нет возможных действий!');

	
echo "Действия в текущем статусе\n\n";
foreach ($actionInStatus as $action) echo $action."\n";

}

php>
