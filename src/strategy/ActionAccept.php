<?php

namespace academy\strategy;

class ActionAccept extends AbstractAction
{
    protected $actionNick = 'accept';
    protected $actionName = 'принять отклик';

public function verifyAccess()
    {
        if ($this->userId === $this->ownerId)
        {
            return true;
        }
    }
}

?>
