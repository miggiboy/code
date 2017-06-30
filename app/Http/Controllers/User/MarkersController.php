<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Marker;

use App\Models\Specialty\Specialty;
use App\Models\Institution\Institution;
use App\Models\Profession\Profession;
use App\Models\Article\Article;

class MarkersController extends Controller
{
    private static $markable = [
        'institution' => Institution::class,
        'specialty' => Specialty::class,
        'profession' => Profession::class,
        'article' => Article::class,
    ];

    protected $model;

    public function __construct()
    {
        parent::__construct();

        $markableType = Request::route('markableType');

        abort_unless(
            in_array($markableType, self::$markable), 424
        );

        $this->model = $markableType::findOrFail(
            Request::route('markableId')
        );
    }

    public function store(Request $request)
    {
        $marker = new Marker;
        $marker->color = $request->color;
        $marker->user()->associate($request->user);
        $this->model->markers()->save($marker);

        return response()->json(null, 200);
    }

    public function update(Request $request)
    {
        $this->model->markers()
            ->where('user_id', $request->user()->id)
            ->update([
                'color' => $request->color
            ]);

        return response()->json(null, 200);
    }

    public function destroy(Request $request)
    {
        $this->model->markers()
            ->wherePivot('user_id', $request->user())
            ->detach();

        return response()->json(null, 200);
    }
}
