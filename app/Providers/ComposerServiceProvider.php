<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use Illuminate\Support\Facades\View;

use App\Http\Composers\{
    CitiesComposer,
    ArticleCategoriesComposer,
    ProfessionCategoriesComposer,
    InstitutionTypeComposer
};

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer(
            ['institutions.index', 'institutions.create', 'institutions.edit'],
            CitiesComposer::class
        );

        View::composer(
            ['professions.index', 'professions.create', 'professions.edit'],
            ProfessionCategoriesComposer::class
        );

        View::composer(
            ['articles.index', 'articles.create', 'articles.edit'],
            ArticleCategoriesComposer::class
        );

        View::composer(
            [
                'specialties.index', 'specialties.create', 'specialties.edit', 'specialties.show',
            ],

            InstitutionTypeComposer::class
        );
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(CitiesConposer::class);

        $this->app->singleton(ProfessionCategoriesComposer::class);

        $this->app->singleton(ArticleCategoriesComposer::class);

        $this->app->singleton(InstitutionTypeComposer::class);
    }
}
