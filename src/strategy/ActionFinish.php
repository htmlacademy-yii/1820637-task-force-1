<?php

namespace academy\strategy;

class ActionFinish extends AbstractAction
{
    protected $actionNick = 'finish';
    protected $actionName = 'завершить';
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
