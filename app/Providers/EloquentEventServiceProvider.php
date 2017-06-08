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
        \App\Models\University\University::observe(\App\Observers\UniversityObserver::class);
        \App\Models\Profession\Profession::observe(\App\Observers\ProfessionObserver::class);
        \App\Models\Article\Article::observe(\App\Observers\ArticleObserver::class);
        \App\Subject::observe(\App\Observers\SubjectObserver::class);
        \App\Models\Specialty\Speciality::observe(\App\Observers\SpecialtyObserver::class);
        \App\Advertisement::observe(\App\Observers\AdvertisementObserver::class);
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
