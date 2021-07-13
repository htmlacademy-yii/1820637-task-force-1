<?php

namespace academy\strategy;

class ActionAppeal extends AbstractAction
{
    protected $actionNick = 'appeal';
    protected $actionName = 'завершить с проблемами';

  public function verifyAccess()
    {
        if ($this->userId === $this->ownerId)
        {
            return true;
        }
    }
}

?>
