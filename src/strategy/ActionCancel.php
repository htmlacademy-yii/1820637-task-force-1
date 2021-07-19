<?php

namespace academy\strategy;

class ActionCancel extends AbstractAction
{
    protected $actionNick = 'cancel';
    protected $actionName = 'отменить';
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
