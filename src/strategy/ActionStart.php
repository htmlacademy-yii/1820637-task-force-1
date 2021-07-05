<?php

namespace academy\strategy;

class ActionStart extends AbstractAction
{
    public function getActionNick()
    {
        return 'start';
    }

    public function getActionName()
    {
        return 'создать';
    }

    public function validateId($userId, $ownerId, $workerId)
    {
        if ($userId == $workerId) return true;
        else return false;
    }
}

?>
