<?php

namespace academy\strategy;

class ActionAccept extends AbstractAction
{
    protected $actionNick = 'accept';
    protected $actionName = 'принять отклик';
    private $task;

    public function __construct($task)
    {
        $this->task = $task;
    }

    public function verifyAccess()
    {
        if ($this->task->userId === $this->task->ownerId)
        {
            return true;
        }
    }
}

?>
