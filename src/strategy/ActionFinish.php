<?php

namespace academy\strategy;

class ActionFinish extends AbstractAction
{
    protected $actionNick = 'finish';
    protected $actionName = 'завершить';

    public function verifyAccess()
    {
        if ($this->userId === $this->ownerId)
        {
            return true;
        }
    }
}

?>
