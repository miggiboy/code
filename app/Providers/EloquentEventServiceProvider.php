<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class EloquentEventServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        \App\Models\College\College::observe(\App\Observers\CollegeObserver::class);
        \App\Models\Institution\Institution::observe(\App\Observers\InstitutionObserver::class);
        \App\Models\Profession\Profession::observe(\App\Observers\ProfessionObserver::class);
        \App\Models\Article\Article::observe(\App\Observers\ArticleObserver::class);
        \App\Models\Subject\Subject::observe(\App\Observers\SubjectObserver::class);
        \App\Models\Specialty\Speciality::observe(\App\Observers\SpecialtyObserver::class);
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
