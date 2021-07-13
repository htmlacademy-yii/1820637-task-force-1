<?php

namespace academy\strategy;

class ActionApply extends AbstractAction
{
    protected $actionNick = 'apply';
    protected $actionName = 'завершить с проблемами';

    public function verifyAccess()
    {
        if ($this->userId === $this->workerId)
        {
            return true;
        }
    }
}

?>
