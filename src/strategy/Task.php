<?php

namespace academy\strategy;

use academy\ex\StatusExistException;
use academy\ex\ActionExistException;

class Task
{

    // Статусы

    const STATUS_NEW = 'new';
    const STATUS_CANCEL = 'cancelled';
    const STATUS_WORK = 'work';
    const STATUS_FAILED = 'failed';
    const STATUS_DONE = 'done';
    const ALL_STATUSES =
        [self::STATUS_NEW,
        self::STATUS_CANCEL,
        self::STATUS_WORK,
        self::STATUS_FAILED,
        self::STATUS_DONE];

    // Свойства

    public $status;
    public $userId;
    public $ownerId;
    public $workedId;

    // Конструктор

    public function __construct(string $status, int $userId, int $ownerId, ?int $workerId)
    {
        $this->status = $status;
        $this->userId = $userId;
        $this->ownerId = $ownerId;
        $this->workerId = $workerId;
        $this->actionStart = new ActionStart($this);
        $this->actionCancel = new ActionCancel($this);
        $this->actionAccept = new ActionAccept($this);
        $this->actionAppeal = new ActionAppeal($this);
        $this->actionFinish = new ActionFinish($this);
        $this->actionApply = new ActionApply($this);
        $this->actionReject = new ActionReject($this);

        try
        {
            if (!in_array($this->status, self::ALL_STATUSES))
            {
                throw new StatusExistException("Статус $this->status не предусмотрен");
            }
        }
        catch (StatusExistException $e)
        {
            echo "StatusExistException: ". $e->getMessage();
            die();
        }

    }

    // Функция возврата статуса

    public function getStatus(): string
    {
        return $this->status;
    }

    //  Возврат карты возможных статусов и действий

      public function getCodesMap(): array
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

    public function getNextStatus(string $action): string
    {
        $allActions =
            [$this->actionStart->getActionNick(),
            $this->actionCancel->getActionNick(),
            $this->actionAccept->getActionNick(),
            $this->actionAppeal->getActionNick(),
            $this->actionFinish->getActionNick(),
            $this->actionApply->getActionNick(),
            $this->actionReject->getActionNick()];

        try
        {
            if (!in_array($action, $allActions))
            {
                throw new ActionExistException("Действие $action не предусмотрено");
            }
        }
        catch (ActionExistException $e)
        {
            echo "ActionExistException: ". $e->getMessage();
            die();
        }

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

  public function getActionInStatus(): array
    {
        switch ($this->status)
        {
            case self::STATUS_NEW:
                $actions = [];
                if ($this->actionCancel->verifyAccess())
                {
                    $actions[] = $this->actionCancel->getActionNick();
                }
                if ($this->actionApply->verifyAccess())
                {
                    $actions[] = $this->actionApply->getActionNick();
                }
                if ($this->actionAccept->verifyAccess())
                {
                    $actions[] = $this->actionAccept->getActionNick();
                }
                break;
            case self::STATUS_CANCEL:
                $actions = [];
                break;
            case self::STATUS_WORK:
                $actions = [];
                if ($this->actionFinish->verifyAccess())
                {
                    $actions[] = $this->actionFinish->getActionNick();
                }
                if ($this->actionAppeal->verifyAccess())
                {
                    $actions[] = $this->actionAppeal->getActionNick();
                }
                if ($this->actionReject->verifyAccess())
                {
                    $actions[] = $this->actionReject->getActionNick();
                }
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
