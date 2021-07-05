<?php

namespace academy\strategy;

abstract class AbstractAction
{
    private $userId;
    private $ownerId;
    private $workerId;

    public function __construct($userId, $ownerId, $workerId)
    {
        $this->userId = $userId;
        $this->ownerId = $ownerId;
        $this->workerId = $workerId;
    }

    abstract public function getActionNick();

    abstract public function getActionName();

    abstract public function validateId($userId, $ownerId, $workerId);
}

?>
