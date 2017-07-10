<?php

namespace App\Http\Controllers\Specialties\Qualifications;

use Illuminate\Http\Request;

use App\Http\Requests\{
    Specialty\QualificationFormRequest
};

use App\Http\Controllers\Controller;

use App\Modules\Search\{
    QualificationSearch
};

use App\Models\Specialty\{
    Qualification,
    Specialty
};

class QualificationsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $qualifications = QualificationSearch::applyFilters($request)
            ->with(['specialty', 'markers'])
            ->orderBy('title')
            ->paginate(15);

        return view('qualifications.index', compact('qualifications'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $specialties = Specialty::getOnly('specialties')
            ->of('college')
            ->orderBy('title')
            ->get();

        return view('qualifications.create', compact('specialties'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(QualificationFormRequest $request)
    {
        $qualifiaction = Qualification::create($request->all());

        return redirect()->route('qualifications.show', $qualifiaction);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Specialty\Qualification  $qualification
     * @return \Illuminate\Http\Response
     */
    public function show(Qualification $qualification)
    {
        return view('qualifications.show', compact('qualification'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Specialty\Qualification  $qualification
     * @return \Illuminate\Http\Response
     */
    public function edit(Qualification $qualification)
    {
        $specialties = Specialty::getOnly('specialties')
            ->of('college')
            ->orderBy('title')
            ->get();

        return view('qualifications.edit', compact('qualification'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Specialty\Qualification  $qualification
     * @return \Illuminate\Http\Response
     */
    public function update(QualificationFormRequest $request, Qualification $qualification)
    {
        $qualifiaction->update($request->all());

        return redirect()
            ->route('qualifications.show', $qualifiaction)
            ->withMessage('Квалификация обновлена');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Specialty\Qualification  $qualification
     * @return \Illuminate\Http\Response
     */
    public function destroy(Qualification $qualification)
    {
        $qualification->delete();

        return redirect()
            ->route('qualifications.index')
            ->withMessage('Квалификация удалена');
    }
}
