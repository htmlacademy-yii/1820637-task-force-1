<?php

namespace academy\strategy;

class ActionFinish extends AbstractAction
{
    public function getActionNick()
    {
        return 'finish';
    }

    public function getActionName()
    {
        return 'завершить';
    }

    public function validateId($userId, $ownerId, $workerId)
    {
        if ($userId == $ownerId) return true;
        else return false;
    }
}

?>
