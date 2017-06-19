<?php

use App\Models\Specialty\Specialty;

/**
 * Temp
 */

/**
 * Home & Feed
 */

Route::get('', 'NewsController@index')->name('home');

Route::post('/feed', 'NewsController@store')->name('feed');

/**
 * User
 */

Route::group(['namespace' => 'User'], function () {

    Route::get('/users/search/autocomplete', 'UsersController@autocomplete')->name('users.autocomplete');

    Route::get('/users/{user}', 'UsersController@show')->name('users.show');

    Route::get('/users/{user}/edit', 'UsersController@edit')->name('users.edit');

    Route::patch('/users/{user}/grant', 'UsersController@grant')->name('users.grant');

    // Registration
    Route::resource('registration', 'RegistrationController', ['only' => 'create', 'store']);

    /**
     * Sessions
     */
    Route::get('/session/create', 'SessionsController@create')->name('session.create');
    Route::post('/session/store', 'SessionsController@store')->name('session.store');

    Route::delete('/session', 'SessionsController@destroy')->name('session.destroy');

    // Profile
    Route::resource('profile', 'ProfileController', ['only' => ['show', 'edit', 'update']]);

    // Markers
    Route::post('/marker', 'MarkersController');
});


/**
* Specialties
*/

Route::group(['namespace' => 'Specialties', 'prefix' => '/{institutionType}-specialties'], function () {

    Route::get('', 'SpecialtiesController@index')->name('specialties.index');

    Route::get('/create', 'SpecialtiesController@create')->name('specialties.create');
    Route::post('', 'SpecialtiesController@store')->name('specialties.store');

    Route::get('/{specialty}/edit', 'SpecialtiesController@edit')->name('specialties.edit');
    Route::patch('/{specialty}', 'SpecialtiesController@update')->name('specialties.update');

    Route::get('/{specialty}', 'SpecialtiesController@show')->name('specialties.show');

    Route::delete('/{specialty}', 'SpecialtiesController@destroy')->name('specialties.destroy');



});

Route::group(['namespace' => 'Specialties'], function () {

    /**
     * Specialty Professions
     */
    Route::resource('specialties.professions', 'SpecialtyProfessionsController', ['except' => ['show']]);

    /**
     * Specialty qualifications
     */
    Route::resource('specialties.qualifications', 'SpecialtyQualificationsController', ['except' => ['show', 'edit', 'update']]);

    /**
     * Specialty institutions
     */
    Route::resource('specialties.institutions', 'SpecialtyInstitutionsController', ['only' => ['index']]);
});


Route::group(['prefix' => '/specialties', 'namespace' => 'Specialties'], function () {

    /**
     * Specialty Search
     */

    Route::group(['prefix' => '/search'], function () {
        Route::get('/autocomplete', 'SpecialtiesController@autocomplete')->name('specialties.autocomplete');
    });

});


/**
 * Professions
 */

Route::group(['namespace' => 'Professions'], function () {

    Route::resource('professions', 'ProfessionsController');

    // Profession Specialties
    Route::resource('professions.specialties', 'ProfessionSpecialtiesController', ['except' => ['edit', 'update', 'show']]);
});


Route::group(['prefix' => '/professions', 'namespace' => 'Professions'], function () {

    /**
     * Professions Search
     */

    Route::group(['prefix' => '/search'], function () {
        Route::get('/autocomplete', 'ProfessionsController@autocomplete')->name('professions.autocomplete');
    });
});


/**
 * Subjects
 */

Route::group(['namespace' => 'Subjects'], function () {

    Route::resource('subjects', 'SubjectsController', ['except' => ['edit', 'update', 'show']]);

    // Subject Media
    Route::resource('subjects.media', 'SubjectMediaController', ['only' => ['index', 'store', 'desctroy']]);
});


// Cities
Route::resource('cities', 'CitiesController', ['only' => ['index', 'store', 'desctroy']]);

/**
 * Institutions
 */

Route::group(['prefix' => '/institutions/{institutionType}', 'namespace' => 'Institution'], function () {

    /**
     * Universities Search
     */

    Route::group(['prefix' => '/search'], function () {
        Route::get('/autocomplete', 'InstitutionsController@autocomplete')->name('universities.autocomplete');
    });

    Route::get('', 'InstitutionsController@index')->name('institutions.index');

    Route::get('/create', 'InstitutionsController@create')->name('institutions.create');
    Route::post('', 'InstitutionsController@store')->name('institutions.store');

    Route::get('/{institution}/edit', 'InstitutionsController@edit')->name('institutions.edit');
    Route::patch('/{institution}', 'InstitutionsController@update')->name('institutions.update');

    Route::delete('/{institution}', 'InstitutionsController@destroy')->name('institutions.destroy');

    Route::get('/{institution}', 'InstitutionsController@show')->name('institutions.show');

    /**
     * University Paid Status
     */
    Route::patch('/{institution}/status', 'UniversityPaidStatusController@toggle')->name('university.status.toggle');


    /**
     * University Pins
     */
     Route::post('/{university}/pin', 'UniversityPinsController@store')->name('universities.pins.store');
     Route::delete('/{university}/pin', 'UniversityPinsController@destroy')->name('universities.pins.destroy');

    /**
     * University Specialties
     */

    Route::group(['prefix' => '/{institution}/specialties/{studyForm}'], function () {
        Route::get('', 'InstitutionSpecialtiesController@index')->name('institutions.specialties.index');

        Route::get('/create', 'InstitutionSpecialtiesController@create')->name('institutions.specialties.create');
        Route::post('', 'InstitutionSpecialtiesController@store')->name('institutions.specialties.store');

        Route::get('/edit', 'InstitutionSpecialtiesController@edit')->name('institutions.specialties.edit');
        Route::patch('', 'InstitutionSpecialtiesController@update')->name('institutions.specialties.update');

        Route::delete('/{specialty}', 'InstitutionSpecialtiesController@destroy')->name('institutions.specialties.destroy');
    });

    /**
     * University Media
     */

    Route::group(['prefix' => '/{instituion}/media'], function () {
        Route::post('', 'InstitutionMediaController@store')->name('instituions.media.store');

        Route::patch('/{mediaId}', 'InstitutionMediaController@toggleLogo');
    });

    Route::delete('/media/{mediaId}', 'InstitutionMediaController@destroy')->name('instituions.media.destroy');

});

/**
 * Maps
 */
Route::post('/map/{institutionType}/{id}', 'MapsController@store')->name('map.store');

Route::patch('/map/{institutionType}/{id}', 'MapsController@update')->name('map.update');

/**
 * Quizzes
 */
Route::resource('quizzes', 'QuizzesController', ['except' => ['edit', 'update']]);

Route::post('/quizzes/preview', 'QuizzesController@preview')->name('quizzes.preview');

Route::post('/answer/{answerId}', 'QuizzesController@check')->name('answer.check');


/**
 * ACL
 */

Route::group(['namespace' => 'AccessControl'], function () {

    /**
     * Roles
     */

    Route::patch('/roles/assign', 'RolesController@assignStore')->name('roles.assignStore');

    Route::get('/roles/assign', 'RolesController@assign')->name('roles.assign');

    Route::get('/roles', 'RolesController@index')->name('roles');

    Route::get('/roles/create', 'RolesController@create')->name('roles.create');
    Route::post('/roles', 'RolesController@store')->name('roles.store');

    Route::get('/roles/{role}', 'RolesController@show')->name('roles.show');
});


// Articles
Route::resource('articles', 'ArticlesController');
