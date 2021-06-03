<?php

class Task
{

// Статусы

const STATUS_NEW = 'new';
const STATUS_CANCEL = 'cancelled';
const STATUS_WORK = 'work';
const STATUS_DEAD = 'dead';
const STATUS_DONE = 'done';

// Действия заказчика

const ACTION_START = 'start';
const ACTION_CANCEL = 'cancel';
const ACTION_ACCEPT = 'accept';
const ACTION_APPEAL = 'appeal';
const ACTION_FINISH = 'finish';

// Действия исполнителя

const ACTION_APPLY = 'apply';
const ACTION_REJECT = 'reject';

// Свойства

private $ownerId;
private $workedId;
private $status;

// Конструктор
// Необязательную переменную на всякий случай убрал направо

public function __construct($status, $ownerId, $workerId = null)
{
    $this->status = $status;
    $this->ownerId = $ownerId;
    $this->workerId = $workerId;
}

// Функция возврата статуса

public function getStatus()
{
    return $this->status;
}

//  Возврат карты возможных статусов и действий

public function getListStatus()
{
    $list = [self::STATUS_NEW => 'новое',
    self::STATUS_CANCEL => "отменено",
    self::STATUS_WORK => "в работе",
    self::STATUS_DEAD => "провалено",
    self::STATUS_DONE => "выполнено",
    self::ACTION_START => "создать",
    self::ACTION_CANCEL => "отменить",
    self::ACTION_ACCEPT => "принять отклик",
    self::ACTION_APPEAL => "заявить о проблеме",
    self::ACTION_FINISH => "завершить",
    self::ACTION_APPLY => "откликнуться",
    self::ACTION_REJECT => 'отказаться'];
    return $list;

}

// Правила перехода

public function getNextStatus()
{
    if ($this->status == self::STATUS_NEW) {
        $nextStatus = [self::ACTION_CANCEL => self::STATUS_CANCEL,
            self::ACTION_APPLY => self::STATUS_NEW,
            self::ACTION_ACCEPT  => self::STATUS_WORK];
    } elseif ($this->status == self::STATUS_WORK) {
        $nextStatus = [self::ACTION_FINISH => STATUS_DONE,
            self::ACTION_APPEAL => STATUS_DEAD,
            self::ACTION_REJECT => STATUS_DEAD];
    } else $nextStatus = ['Это тупиковый статус!'];
    return $nextStatus;
}


// Возможные действия в статусе - реализовано массивом

public function getActionInStatus()
{
    if ($this->status == self::STATUS_NEW) {
        $actions = [self::ACTION_CANCEL, self::ACTION_APPLY, self::ACTION_ACCEPT];
    } elseif ($this->status == self::STATUS_WORK) {
        $actions = [self::ACTION_FINISH, self::ACTION_APPEAL, self::ACTION_REJECT];
    } else $actions = ['Нет возможных действий!'];
    return $actions;
}

}


?>
