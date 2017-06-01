<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RedirectsToPrimaryAppController extends Controller
{
    public function university($slug)
    {
        return static::redirect('universities', $slug);
    }

    public function college($slug)
    {
        return static::redirect('colleges', $slug);
    }

    public function specialty($slug)
    {
        return static::redirect('specialties', $slug);
    }

    public function profession($slug)
    {
        return static::redirect('professions', $slug);
    }

    public function article($slug)
    {
        return static::redirect('articles', $slug);
    }

    private function redirect($category, $slug)
    {
        return redirect()->away(
            config('primary_app.urls.' . $category) . $slug
        );
    }
}
