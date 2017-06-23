<?php

namespace App\Modules\Search;

use Illuminate\Http\Request;
use App\Models\Specialty\Specialty;

class SpecialtySearch
{
    public static function filter(Request $request)
    {
        $q = Specialty::query();

        $q->getOnly('specialties')->of($request->route('institutionType'));

        if ($request->has('query')) {
            $q->like(request('query'));
        }

        if ($request->has('direction')) {
            $q->inDirection(request('direction'));
        }

        if ($request->has('without_description')) {
            $q->hasDescription(false);
        }

        if ($request->has('without_direction')) {
            $q->hasNoDirection();
        }

        if ($request->has('without_subjects')) {
            $q->has('subjects', false);
        }

        if ($request->has('marked')) {
            $q->markedByCurrentUser();
        }

        return $q;
    }
}
