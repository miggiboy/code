<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use Illuminate\Database\Eloquent\Relations\Relation;

use App\Models\Article\Article;
use App\Models\Subject\Subject;
use App\Models\Specialty\Specialty;
use App\Models\Profession\Profession;
use App\Models\Institution\Institution;

use App\Models\User\Marker;
use Spatie\MediaLibrary\Media;

class EloquentServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        Relation::morphMap([
            'article' => Article::class,
            'institution' => Institution::class,
            'specialty' => Specialty::class,
            'profession' => Profession::class,
            'subject' => Subject::class,

            'media' => Media::class,
            'marker' => Marker::class,
        ]);

        Specialty::observe(\App\Observers\QualificationObserver::class);
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
