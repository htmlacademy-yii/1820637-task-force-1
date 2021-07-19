<?php

namespace academy\strategy;

class ActionStart extends AbstractAction
{
    protected $actionNick = 'start';
    protected $actionName = 'создать';
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
