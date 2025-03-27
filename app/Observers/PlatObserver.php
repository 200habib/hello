<?php
namespace App\Observers;

use App\Models\Plat;
use App\Models\User;
use App\Notifications\NewPlatNotification;

class PlatObserver
{
    public function created(Plat $plat)
    {
        $users = User::all();
        foreach ($users as $user) {
            $user->notify(new NewPlatNotification($plat));
        }
    }
}
