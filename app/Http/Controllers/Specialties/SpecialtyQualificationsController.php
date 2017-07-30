<?php

namespace App\Http\Controllers\Specialties;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Specialty\Specialty;

class SpecialtyQualificationsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Specialty $specialty)
    {
        $specialty->load(['qualifications' => function ($q) {
            $q->orderBy('title');
        }]);

        return view('specialties.qualifications.index', compact('specialty'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, Specialty $specialty)
    {
        $qualifications = Specialty::getOnly('qualifications')
            ->orderBy('title')
            ->get();

        return view(
            'specialties.qualifications.create', compact('specialty', 'qualifications')
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Specialty $specialty)
    {
        foreach ($request->qualifications as $qualification) {
            $qualification = Specialty::find($qualification);

            $qualification->specialty()->associate($specialty);

            $qualification->save();
        }

        Specialty::where('parent_id', $specialty->id)
            ->whereNotIn('id', $request->qualifications)
            ->delete();

        return redirect()
            ->route('specialties.show', [$specialty->institution_type, $specialty])
            ->withMessage('Список квалификаций обновлен');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Specialty $specialty, Specialty $qualification)
    {
        $qualification->specialty()->dissociate();

        $qualification->save();

        return back()->withMessage('Квалификация откреплена');
    }
}
