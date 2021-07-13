<?php

namespace academy\strategy;

class ActionReject extends AbstractAction
{
   protected $actionNick = 'reject';
   protected $actionName = 'отказаться';

   public function verifyAccess()
    {
        if ($this->userId === $this->workerId)
        {
            return true;
        }
    }
}

?>
