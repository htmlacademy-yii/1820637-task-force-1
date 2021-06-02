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
    echo "<b>Текущий статус:</b><br>";
    return $this->status;
}

// Вывод списка возможных статусов и действий

public function getListStatus()
{
    $status = array("STATUS_NEW" => self::STATUS_NEW,
    "STATUS_CANCEL" => self::STATUS_CANCEL,
    "STATUS_WORK" => self::STATUS_WORK,
    "STATUS_DEAD" => self::STATUS_DEAD,
    "STATUS_DONE" => self::STATUS_DONE);

    $action = array("ACTION_NEW" => self::ACTION_NEW,
    "ACTION_CANCEL" => self::ACTION_CANCEL,
    "ACTION_WORK" => self::ACTION_WORK,
    "ACTION_DEAD" => self::ACTION_DEAD,
    "ACTION_DONE" => self::ACTION_DONE,
    "ACTION_APPLY" => self::ACTION_APPLY,
    "ACTION_STRIKE" => self::ACTION_STRIKE);

    echo "<b>Список статусов:</b><br>";
    foreach($status as $key => $value) {
        echo $key."\t=>\t".$value."<br>";
    }

    echo "<b>Список действий:</b><br>";
    foreach($action as $key => $value) {
        echo $key."\t=>\t".$value."<br>";
    }
}

// Вывод на печать правил перехода ("Откликнуться" не меняет статус)

public function getNextStatus()
{
    $actionToStatus = array(self::ACTION_NEW => self::STATUS_NEW,
    self::ACTION_CANCEL => self::STATUS_CANCEL,
    self::ACTION_WORK => self::STATUS_WORK,
    self::ACTION_DEAD => self::STATUS_DEAD,
    self::ACTION_DONE => self::STATUS_DONE,
    self::ACTION_APPLY => self::STATUS_NEW,
    self::ACTION_STRIKE => self::STATUS_DEAD);

    echo "<b>Действие => Статус:</b><br>";
    foreach($actionToStatus as $key => $value) {
        echo $key."\t=>\t".$value."<br>";
    }
}

// Вывод на печать возможных действий в статусе

public function getActionInStatus()
{
    if ($this->status == self::STATUS_NEW) {
        $actionInStatus = array(self::ACTION_CANCEL, self::ACTION_APPLY, self::ACTION_WORK);
    } elseif ($this->status == self::STATUS_WORK) {
        $actionInStatus = array (self::ACTION_DONE, self::ACTION_APPLY, self::ACTION_STRIKE);
    } else $actionInStatus = array ('Нет возможных действий!');

    echo "<b>Действия в текущем статусе:</b><br>";
    foreach ($actionInStatus as $action) {
        echo $action."<br>";
    }
}
}

?>
