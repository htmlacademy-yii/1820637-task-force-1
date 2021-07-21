<?php

namespace academy\strategy;

class ActionApply extends AbstractAction
{
    protected $actionNick = 'apply';
    protected $actionName = 'откликнуться';
    private $task;

    public function __construct($task)
    {
        $this->task = $task;
    }

    public function verifyAccess()
    {
       if ($this->task->userId === $this->task->workerId)
       {
            return true;
       }
    }
}

?>
