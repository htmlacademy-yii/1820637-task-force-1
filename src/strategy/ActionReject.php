<?php

namespace academy\strategy;

class ActionReject extends AbstractAction
{
    public function getActionNick()
    {
        return 'reject';
    }

    public function getActionName()
    {
        return 'отказаться';
    }

    public function validateId($userId, $ownerId, $workerId)
    {
        if ($userId == $workerId) return true;
        else return false;
    }
}

?>
