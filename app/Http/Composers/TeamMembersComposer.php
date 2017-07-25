<?php

namespace App\Http\Composers;

use Illuminate\View\View;
use App\Models\User\User;

class TeamMembersComposer
{
    protected $team;

    public function compose(View $view)
    {
        if (! $this->team) {
            $this->team = User::team()->active()->oldest()->get();
        }

        return $view->with('team', $this->team);
    }
}
