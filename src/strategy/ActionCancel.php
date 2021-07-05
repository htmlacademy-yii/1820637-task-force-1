<?php

namespace academy\strategy;

class ActionCancel extends AbstractAction
{
    public function getActionNick()
    {
        return 'cancel';
    }

    public function getActionName()
    {
        return 'отменить';
    }

    public function validateId($userId, $ownerId, $workerId)
    {
        if ($userId == $ownerId) return true;
        else return false;
    }
}

?>
