<?php

namespace academy\strategy;

abstract class AbstractAction
{
    protected $actionNick;
    protected $actionName;

    public function getActionNick()
    {
        return $this->actionNick;
    }

    public function getActionName()
    {
        return $this->actionName;
    }

    abstract public function verifyAccess();
}

?>
