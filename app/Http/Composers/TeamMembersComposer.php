<?php

namespace App\Http\Composers;

use Illuminate\View\View;
use App\Models\User\User;

use Auth;

class TeamMembersComposer
{
    protected $team;

    public function compose(View $view)
    {
        if (! $this->team) {
            $this->team = User::team()
                ->active()
                ->except(Auth::user())
                ->oldest()
                ->get();
        }

        $this->team->prepend(Auth::user());

        return $view->with('team', $this->team);
    }
}
