<?php

namespace App\Http\Controllers\Universities;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\University\University;
use App\Modules\Institution\PinGenerator;

class InstitutionPinsController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, University $university)
    {
        $university->update([
            'pin' => PinGenerator::generateUniquePin()
        ]);

        return redirect()->route('universities.show', $university->slug)->withMessage('Пин сгенерирован');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\University\University  $university
     * @return \Illuminate\Http\Response
     */
    public function edit(University $university)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\University\University  $university
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, University $university)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\University\University  $university
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, University $university)
    {
        $university->update(['pin' => null]);

        return back()->withMessage('Пин удален. Представители вуза не смогут получить доступ к личному кабинету');
    }
}
