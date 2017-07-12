<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\User\Marker;

use App\Models\Specialty\Specialty;
use App\Models\Institution\Institution;
use App\Models\Profession\Profession;
use App\Models\Article\Article;

class MarkersController extends Controller
{
    const MARKABLE = [
        'institution' => Institution::class,
        'specialty' => Specialty::class,
        'profession' => Profession::class,
        'article' => Article::class,
    ];

    protected $model;

    public function __construct()
    {
        parent::__construct();

        $markableType = request()->route('markableType');

        abort_unless(
            array_key_exists($markableType, self::MARKABLE), 404
        );

        $this->model =
            self::MARKABLE[$markableType]::findOrFail(
                request()->route('markableId')
            );
    }

    public function store(Request $request)
    {
        if (Marker::colorIsNotAllowed($request->color)) {
            abort(404);
        }

        $marker = new Marker;
        $marker->color = $request->color;
        $marker->user()->associate($request->user());
        $this->model->markers()->save($marker);

        return back()->withMessage('Отметка добавлена');
    }

    public function destroy(Request $request)
    {
        $this->model->markers()
            ->where('user_id', $request->user()->id)
            ->where('color', $request->color)
            ->delete();

        return back()->withMessage('Отметка удалена');
    }
}
