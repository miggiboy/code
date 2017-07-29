<?php

namespace App\Http\Controllers\Specialties\Qualifications;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use App\Http\Requests\{
    SpecialtyFormRequest
};

use App\Modules\Search\{
    SpecialtySearch
};

use App\Models\Specialty\{
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
        $qualifications = SpecialtySearch::applyFiltersTo('qualifications', $request)
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
        $specialties = $this->getCollegeSpecialtes();

        return view('qualifications.create', compact('specialties'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SpecialtyFormRequest $request)
    {
        $qualifiaction = Specialty::create($request->all());

        return redirect()->route('qualifications.show', $qualifiaction);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Specialty\Specialty  $qualification
     * @return \Illuminate\Http\Response
     */
    public function show(Specialty $qualification)
    {
        return view('qualifications.show', compact('qualification'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Specialty\Specialty  $qualification
     * @return \Illuminate\Http\Response
     */
    public function edit(Specialty $qualification)
    {
        $specialties = $this->getCollegeSpecialtes();

        return view('qualifications.edit', compact('qualification', 'specialties'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Specialty\Specialty  $qualification
     * @return \Illuminate\Http\Response
     */
    public function update(SpecialtyFormRequest $request, Specialty $qualification)
    {
        $qualifiaction->update($request->all());

        return redirect()
            ->route('qualifications.show', $qualifiaction)
            ->withMessage('Квалификация обновлена');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Specialty\Specialty  $qualification
     * @return \Illuminate\Http\Response
     */
    public function destroy(Specialty $qualification)
    {
        $qualification->delete();

        return redirect()
            ->route('qualifications.index')
            ->withMessage('Квалификация удалена');
    }

    private function getCollegeSpecialtes()
    {
        return Specialty::getOnly('specialties')
            ->of('college')
            ->orderBy('title')
            ->get();
    }
}
