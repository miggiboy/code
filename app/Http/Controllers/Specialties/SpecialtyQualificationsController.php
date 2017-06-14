<?php

namespace App\Http\Controllers\Specialties;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Specialty\Speciality;

class SpecialtyQualificationsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Speciality $specialty)
    {
        $specialty->load('qualifications');
        return view('specialties.qualifications.index', compact('specialty'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, Speciality $specialty)
    {
        $qualifications = Speciality::whereNotNull('parent_id')->get();
        return view('specialties.qualifications.create', compact('specialty', 'qualifications'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Speciality $specialty)
    {
        foreach ($request->qualifications as $qualification) {
            Speciality::find($qualification)->update(['parent_id' => $specialty->id]);
        }

        return redirect()->route('specialties.show', $specialty)->withMessage('Квалификации прикреплены');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Speciality $specialty, Speciality $qualification)
    {
        $qualification->update(['parent_id' => '99999999']);

        return back()->withMessage('Квалификация откреплена');
    }
}
