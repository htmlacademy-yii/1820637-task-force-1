<?php

namespace academy\strategy;

class Task
{

    // Статусы

    const STATUS_NEW = 'new';
    const STATUS_CANCEL = 'cancelled';
    const STATUS_WORK = 'work';
    const STATUS_FAILED = 'failed';
    const STATUS_DONE = 'done';

    // Свойства

    private $ownerId;
    private $workedId;
    private $status;
    private $userId;
    private $actionStart;
    private $actionCancel;
    private $actionAccept;
    private $actionAppeal;
    private $actionFinish;
    private $actionApply;
    private $actionReject;

      // Конструктор

    public function __construct($status, $userId, $ownerId, $workerId)
    {
        $this->status = $status;
        $this->userId = $userId;
        $this->ownerId = $ownerId;
        $this->workerId = $workerId;
        $this->actionStart = new ActionStart;
        $this->actionCancel = new ActionCancel;
        $this->actionAccept = new ActionAccept;
        $this->actionAppeal = new ActionAppeal;
        $this->actionFinish = new ActionFinish;
        $this->actionApply = new ActionApply;
        $this->actionReject = new ActionReject;
    }

    // Функция возврата статуса

    public function getStatus()
    {
        return $this->status;
    }

    //  Возврат карты возможных статусов и действий

    public function getCodesMap()
    {
        $list = [self::STATUS_NEW => 'новое',
        self::STATUS_CANCEL => "отменено",
        self::STATUS_WORK => "в работе",
        self::STATUS_FAILED => "провалено",
        self::STATUS_DONE => "выполнено",
        $this->actionStart->getActionNick() => $this->actionStart->getActionName(),
        $this->actionCancel->getActionNick() => $this->actionCancel->getActionName(),
        $this->actionAccept->getActionNick() => $this->actionAccept->getActionName(),
        $this->actionAppeal->getActionNick() => $this->actionAppeal->getActionName(),
        $this->actionFinish->getActionNick() => $this->actionFinish->getActionName(),
        $this->actionApply->getActionNick() => $this->actionApply->getActionName(),
        $this->actionReject->getActionNick() => $this->actionReject->getActionName()];
        return $list;
    }

    // Правила перехода

    public function getNextStatus($action)
    {
        switch ($action)
        {
            case $this->actionStart->getActionNick():
                $nextStatus = self::STATUS_NEW;
                break;
            case $this->actionCancel->getActionNick():
                $nextStatus = self::STATUS_CANCEL;
                break;
            case $this->actionAccept->getActionNick():
                $nextStatus = self::STATUS_WORK;
                break;
            case $this->actionAppeal->getActionNick():
                $nextStatus = self::STATUS_FAILED;
                break;
            case $this->actionFinish->getActionNick():
                $nextStatus = self::STATUS_DONE;
                break;
            case $this->actionApply->getActionNick():
                $nextStatus = self::STATUS_NEW;
                break;
            case $this->actionReject->getActionNick():
                $nextStatus = self::STATUS_FAILED;
                break;
        }
        return $nextStatus;
    }

    // Возможные действия в статусе сообразно роли - реализовано массивом

    public function getActionInStatus()
    {
        switch ($this->status)
        {
            case self::STATUS_NEW:
                $actions = [];
                if ($this->actionCancel->validateId($this->userId, $this->ownerId, $this->workerId) == true)
                    $actions[] = $this->actionCancel->getActionNick();
                if ($this->actionApply->validateId($this->userId, $this->ownerId, $this->workerId) == true)
                    $actions[] = $this->actionApply->getActionNick();
                if ($this->actionAccept->validateId($this->userId, $this->ownerId, $this->workerId) == true)
                    $actions[] = $this->actionAccept->getActionNick();
                break;
          case self::STATUS_CANCEL:
                $actions = [];
                break;
            case self::STATUS_WORK:
                $actions = [];
                if ($this->actionFinish->validateId($this->userId, $this->ownerId, $this->workerId) == true)
                    $actions[] = $this->actionFinish->getActionNick();
                if ($this->actionAppeal->validateId($this->userId, $this->ownerId, $this->workerId) == true)
                    $actions[] = $this->actionAppeal->getActionNick();
                if ($this->actionReject->validateId($this->userId, $this->ownerId, $this->workerId) == true)    
                    $actions[] = $this->actionReject->getActionNick();
                break;
            case self::STATUS_FAILED:
                $actions = [];
                break;
            case self::STATUS_DONE:
                $actions = [];
                break;
      }
      return $actions;
    }
}

?>
