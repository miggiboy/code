<?php

namespace App\Http\Controllers\User;

use App\Marker;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MarkersController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:developer|admin|moderator');
    }

    private static $markableTypes = [
        'College'       => '\\App\Models\\College\\College',
        'University'    => '\\App\Models\\University\\University',
        'Specialty'     => '\\App\Models\\Specialty\\Speciality',
        'Profession'    => '\\App\Models\\Profession\\Profession',
    ];

    /**
     * Toggles mark
     * @return view
     */
    public function __invoke(Request $request)
    {
        $this->validate($request, [
            'markable_type' => 'required',
            'markable_id'   => 'required',
        ]);

        if (! isset(self::$markableTypes[ucfirst($request->markable_type)])) {
            throw new \Exception ('Class ' . ucfirst($request->markable_type) . ' not found.');
        }

        $className = self::$markableTypes[ucfirst($request->markable_type)];

        $markable = $className::find($request->markable_id);

        $mark = $markable->marks()->firstOrNew([
            'user_id'   => $request->user()->id,
        ]);

        if ($mark->exists) {
            $markable->marks()->where('user_id', $request->user()->id)->delete($mark);
        } else {
            $mark->save();
        }

        return response(null, 200);
    }
}
