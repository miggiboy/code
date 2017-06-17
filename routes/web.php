<?php

/**
 * Temp
 */


/**
 * Storage linker (Shouldn't be uncommented, deleted or visited)
 */

// Route::get('/link', function () {
//     App::make('files')->link(storage_path('app/public'), public_path('storage'));
// });



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

    /**
     * Registration
     */
    Route::resource('registration', 'RegistrationController', ['only' => 'create', 'store']);


    /**
     * Sessions
     */
    Route::resource('sessions', 'SessionsController', ['only' => ['create', 'store', 'destroy']]);

    /**
     * Profile
     */
    Route::resource('profile', 'ProfileController', ['only' => ['show', 'edit', 'update']]);

    /**
     * Markers
     */
    Route::post('/marker', 'MarkersController');
});


/**
* Specialties
*/

Route::group(['namespace' => 'Specialties'], function () {

    Route::resource('specialties', 'SpecialtiesController');

    // Specialty Professions
    Route::resource('specialties.professions', 'SpecialtyProfessionsController', ['only' => ['edit', 'update', 'show']]);

    // Specialty qualifications
    Route::resource('specialties.qualifications', 'SpecialtyQualificationsController', ['except' => ['show', 'edit', 'update']]);

    // Specialty institutions
    Route::get('specialties.institutions', 'SpecialtyInstitutionsController@index', ['only' => ['index']]);
});



Route::group(['prefix' => '/specialties', 'namespace' => 'Specialties'], function () {

    /**
     * Specialty Search
     */

    Route::group(['prefix' => '/search'], function () {
        Route::get('', 'SpecialtiesController@search')->name('specialties.search');
        Route::get('/autocomplete', 'SpecialtiesController@autocomplete')->name('specialties.autocomplete');
        Route::get('/college/specialties', 'SpecialtiesController@searchCollegeSpecialties');
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
        Route::get('', 'ProfessionsController@search')->name('professions.search');
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


/**
 * Cities
 */

Route::resource('cities', 'CitiesController', ['only' => ['index', 'store', 'desctroy']]);

/**
 * Universities
 */

Route::group(['prefix' => '/institutions/{institutionType}', 'namespace' => 'Institution'], function () {

    /**
     * Universities Search
     */

    Route::group(['prefix' => '/search'], function () {
        Route::get('', 'InstitutionsController@search')->name('institutions.search');
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

    Route::group(['prefix' => '/{university}/specialties/{studyForm}'], function () {
        Route::get('', 'UniversitySpecialtiesController@index')->name('university.specialties');

        Route::get('/create', 'UniversitySpecialtiesController@create')->name('university.specialties.create');
        Route::post('', 'UniversitySpecialtiesController@store')->name('university.specialities');

        Route::get('/edit', 'UniversitySpecialtiesController@edit')->name('university.specialties.edit');
        Route::patch('', 'UniversitySpecialtiesController@update')->name('university.specialties');

        Route::delete('/{speciality}', 'UniversitySpecialtiesController@destroy')->name('university.specialties.destroy');
    });

    /**
     * University Media
     */

    Route::group(['prefix' => '/{university}/media'], function () {
        Route::post('', 'UniversityMediaController@store')->name('university.images.store');

        Route::patch('/{mediaId}', 'UniversityMediaController@toggleLogo');
    });

    Route::delete('/media/{mediaId}', 'UniversityMediaController@destroy')->name('university.images.destroy');

    /**
     * Maps
     */
    Route::post('/map/{institutionType}/{id}', 'MapsController@store')->name('map.store');

    Route::patch('/map/{institutionType}/{id}', 'MapsController@update')->name('map.update');

});

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

/**
 * Articles
 */

Route::resource('articles', 'ArticlesController');
