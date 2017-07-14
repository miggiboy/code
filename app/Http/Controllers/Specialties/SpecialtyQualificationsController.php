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
        $specialty->load('qualifications');

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
        foreach ($request->qualifications as $id) {
            Specialty::find($id)
                ->specialty()
                ->associate($specialty);
        }

        return redirect()
            ->route('specialties.show', $specialty)
            ->withMessage('Квалификации прикреплены');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Specialty $specialty, Specialty $qualification)
    {
        // TODO: use disassociate method insted
        $qualification->update(['parent_id' => null]);

        return back()->withMessage('Квалификация откреплена');
    }
}
