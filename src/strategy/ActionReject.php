<?php

namespace academy\strategy;

class ActionReject extends AbstractAction
{
   protected $actionNick = 'reject';
   protected $actionName = 'отказаться';
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
