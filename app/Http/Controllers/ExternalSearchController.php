<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\University\University;
use App\Models\College\College;
use App\Models\Profession\Profession;
use App\Models\Specialty\Speciality;


class ExternalSearchController extends Controller
{
    public function university(University $university)
    {
        return static::search(trim($university->title) . ', ' . trim($university->city->title));
    }

    public function college(College $college)
    {
        return static::search(trim($college->title) . ', ' . trim($college->city->title));
    }

    public function specialty(Speciality $specialty)
    {
        return static::search(
            'Специальность ' . trim($specialty->title) . ' ' . trim($specialty->code) . ' Казахстан'
        );
    }

    public function profession(Profession $profession)
    {
        return static::search('Профессия ' . trim($profession->title));
    }

    private function search($query)
    {
        return redirect()->away(config('google.search.url') . $query);
    }
}
