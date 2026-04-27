<?php

namespace App\Observers;

use App\Models\ElephpantUser;

class ElephpantUserObserver
{
    public function saved(ElephpantUser $elephpantUser)
    {
        if ($elephpantUser->quantity <= 0) {
            $elephpantUser->delete();
        }
    }
}
