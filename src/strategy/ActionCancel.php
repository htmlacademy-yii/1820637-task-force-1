<?php

namespace academy\strategy;

class ActionCancel extends AbstractAction
{
    protected $actionNick = 'cancel';
    protected $actionName = 'отменить';

    public function verifyAccess()
    {
        if ($this->userId === $this->ownerId)
        {
            return true;
        }
    }
}

?>
