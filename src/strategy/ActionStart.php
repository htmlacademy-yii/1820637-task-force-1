<?php

namespace academy\strategy;

class ActionStart extends AbstractAction
{
    protected $actionNick = 'start';
    protected $actionName = 'создать';

public function verifyAccess()
    {
        if ($this->userId === $this->ownerId)
        {
            return true;
        }
    }
}

?>
