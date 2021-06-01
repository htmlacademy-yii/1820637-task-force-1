<?php

class Task
{

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


// Конструктор

public function __construct($ownerId, $workerId, $status)
{
    $this->ownerId = $ownerId;
    $this->workerId = $workerId;
    $this->status = $status;
}

// Функция возврата статуса

public function getStatus()
{
    return $this->status;
}

// Вывод списка возможных статусов и действий

public function getListStatus()
{
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
    "ACTION_APPLY" => 'Откликнуться',
    "ACTION_STRIKE" => 'Отказаться');

    echo "Статусы:\n";
    foreach($status as $key => $value) {
        echo $key."\t=>\t".$value."\n";
    }

    echo "Действия:\n";
    foreach($action as $key => $value) {
        echo $key."\t=>\t".$value."\n";
    }
}

// Вывод на печать правил перехода ("Откликнуться" не меняет статус)

public function getNextStatus()
{
    $actionToStatus = array("ACTION_NEW" => 'STATUS_NEW',
    "ACTION_CANCEL" => 'STATUS_CANCEL',
    "ACTION_WORK" => 'STATUS_WORK',
    "ACTION_DEAD" => 'STATUS_DEAD',
    "ACTION_DONE" => 'STATUS_DONE',
    "ACTION_APPLY" => 'STATUS_NEW',
    "ACTION_STRIKE" => 'STATUS_DEAD');

    echo "Статус после действия:\n";
    foreach($actionToStatus as $key => $value) {
        echo $key."\t=>\t".$value."\n";
    }
}

// Вывод на печать возможных действий в статусе

public function getActionInStatus()
{
    if ($this->status == 'STATUS_NEW') {
        $actionInStatus = array('ACTION_CANCEL', 'ACTION_APPLY', 'ACTION_WORK');
    } elseif ($this->status == 'STATUS_WORK') {
        $actionInStatus = array ('ACTION_DONE', 'ACTION_APPLY', 'ACTION_STRIKE');
    } else $actionInStatus = array ('Нет возможных действий!');

    echo "Действия в текущем статусе:\n";
    foreach ($actionInStatus as $action) {
        echo $action."\n";
    }
}
}

php>
