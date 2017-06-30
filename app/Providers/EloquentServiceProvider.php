<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use Illuminate\Database\Eloquent\Relations\Relation;

use App\Models\Article\Article;
use App\Models\Subject\Subject;
use App\Models\Specialty\Specialty;
use App\Models\Profession\Profession;
use App\Models\Institution\Institution;

class EloquentServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        Subject::observe(\App\Observers\SubjectObserver::class);
        Article::observe(\App\Observers\ArticleObserver::class);
        Specialty::observe(\App\Observers\SpecialtyObserver::class);
        Profession::observe(\App\Observers\ProfessionObserver::class);
        Institution::observe(\App\Observers\InstitutionObserver::class);

        Relation::morphMap([
            'article' => Article::class,
            'institution' => Institution::class,
            'specialty' => Specialty::class,
            'profession' => Profession::class,
            'subject' => Subject::class,
        ]);
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
