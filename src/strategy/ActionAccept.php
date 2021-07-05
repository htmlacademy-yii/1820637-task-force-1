<?php

namespace academy\strategy;

class ActionAccept extends AbstractAction
{
    public function getActionNick()
    {
        return 'accept';
    }

    public function getActionName()
    {
        return 'принять отклик';
    }

    public function validateId($userId, $ownerId, $workerId)
    {
        if ($userId == $ownerId) return true;
        else return false;
    }
}

?>
