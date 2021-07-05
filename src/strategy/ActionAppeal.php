<?php

namespace academy\strategy;

class ActionAppeal extends AbstractAction
{
    public function getActionNick()
    {
        return 'appeal';
    }

    public function getActionName()
    {
        return 'завершить с проблемами';
    }

    public function validateId($userId, $ownerId, $workerId)
    {
        if ($userId == $ownerId) return true;
        else return false;
    }
}

?>
