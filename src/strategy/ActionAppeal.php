<?php

namespace academy\strategy;

class ActionAppeal extends AbstractAction
{
    protected $actionNick = 'appeal';
    protected $actionName = 'завершить с проблемами';
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
