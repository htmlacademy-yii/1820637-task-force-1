<?php

namespace academy\strategy;

class ActionApply extends AbstractAction
{
    public function getActionNick()
    {
        return 'apply';
    }

    public function getActionName()
    {
        return 'откликнуться';
    }

    public function validateId($userId, $ownerId, $workerId)
    {
        if ($userId == $workerId) return true;
        else return false;
    }
}

?>
