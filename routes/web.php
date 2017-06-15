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

    Route::get('/register', 'RegistrationController@create')->name('register');
    Route::post('/register', 'RegistrationController@store');


    /**
     * Sessions
     */

    Route::get('/login', 'SessionsController@create')->name('login');
    Route::post('/login', 'SessionsController@store');

    Route::get('/logout', 'SessionsController@destroy')->name('logout');

    /**
     * Profile
     */

    Route::get('/profile', 'ProfileController@show')->name('profile');

    Route::get('/profile/edit', 'ProfileController@edit')->name('profile.edit');
    Route::patch('/profile', 'ProfileController@update')->name('profile.update');

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

    /**
     * Specialty Professions
     */
    Route::resource('specialties.professions', 'SpecialtyProfessionsController')->except(['edit', 'update', 'show']);


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

    /**
     * Specialty qualifications
     */
    Route::get('/{specialty}/qualifications', 'SpecialtyQualificationsController@index')->name('specialties.qualifications.index');

    Route::get('/{specialty}/qualifications/create', 'SpecialtyQualificationsController@create')
        ->name('specialties.qualifications.create');

    Route::post('/{specialty}/qualifications', 'SpecialtyQualificationsController@store')->name('specialties.qualifications.store');

    Route::delete('/{specialty}/qualifications/{qualification}', 'SpecialtyQualificationsController@destroy')
        ->name('specialties.qualifications.destroy');

    /**
     * Specialty related institutions
     */
    Route::get('/{specialty}/institutions', 'SpecialtyInstitutionsController@index')->name('specialties.institutions.index');

});


/**
 * Professions
 */

Route::group(['namespace' => 'Professions'], function () {
    Route::resource('professions', 'ProfessionsController');

    /**
     * Profession Specialties
     */
    Route::resource('professions.specialties', 'ProfessionSpecialtiesController')->except(['edit', 'update', 'show']);
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

    Route::resource('subjects', 'SubjectsController')->except(['edit', 'update', 'show']);

    /**
     * Subject Media
     */

    Route::resource('subjects.media', 'SubjectMediaController')->only(['index', 'store', 'desctroy']);

});


/**
 * Cities
 */

Route::resource('cities', 'CitiesController')->only(['index', 'store', 'desctroy']);

/**
 * Universities
 */

Route::group(['prefix' => '/ins/{institutionType}', 'namespace' => 'Institution'], function () {

    /**
     * Universities Search
     */

    Route::group(['prefix' => '/search'], function () {
        Route::get('', 'InstitutionsController@search')->name('universities.search');
        Route::get('/autocomplete', 'InstitutionsController@autocomplete')->name('universities.autocomplete');
    });

    Route::get('', 'InstitutionsController@index')->name('universities');

    Route::get('/create', 'InstitutionsController@create')->name('universities.create');
    Route::post('', 'InstitutionsController@store');

    Route::get('/{university}/edit', 'InstitutionsController@edit')->name('universities.edit');
    Route::patch('/{university}', 'InstitutionsController@update')->name('universities.update');

    Route::delete('/{university}', 'InstitutionsController@destroy')->name('universities.destroy');

    Route::get('/{slug}', 'InstitutionsController@show')->name('universities.show');

    /**
     * University Paid Status
     */
    Route::patch('/{university}/status', 'UniversityPaidStatusController@toggle')->name('university.status.toggle');


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

});


/**
 * Colleges
 */

Route::group(['prefix' => '/colleges', 'namespace' => 'Colleges'], function () {

    /**
     * Colleges Search
     */
    Route::get('/search/autocomplete', 'CollegesController@autocomplete')->name('colleges.autocomplete');
    Route::get('/search', 'CollegesController@search')->name('colleges.search');

    Route::get('', 'CollegesController@index')->name('colleges');

    Route::get('/create', 'CollegesController@create')->name('colleges.create');
    Route::post('', 'CollegesController@store');

    Route::get('/{slug}', 'CollegesController@show')->name('colleges.show');

    Route::get('/{college}/edit', 'CollegesController@edit')->name('colleges.edit');
    Route::patch('/{college}', 'CollegesController@update')->name('colleges.update');

    Route::delete('/{college}', 'CollegesController@destroy')->name('colleges.destroy');

    /**
     * College paid status
     */
    Route::patch('/{college}/status', 'CollegePaidStatusController@toggle')->name('college.status.toggle');

    /**
     * College specialties
     */

    Route::group(['prefix' => '/{college}/specialties/{studyForm}'], function () {
        Route::get('', 'CollegeSpecialtiesController@index')->name('college.specialties');

        Route::get('/create', 'CollegeSpecialtiesController@create')->name('college.specialties.create');
        Route::post('', 'CollegeSpecialtiesController@store')->name('college.specialities');

        Route::get('/edit', 'CollegeSpecialtiesController@edit')->name('college.specialties.edit');
        Route::patch('', 'CollegeSpecialtiesController@update')->name('college.specialties');

        Route::delete('/{speciality}', 'CollegeSpecialtiesController@destroy')->name('college.specialties.destroy');
    });

    /**
     * College Media
     */

    Route::group(['prefix' => '/{college}/media'], function () {
        Route::post('', 'CollegeMediaController@store')->name('college.images.store');

        Route::patch('/{mediaId}', 'CollegeMediaController@toggleLogo');
    });

    Route::delete('/media/{mediaId}', 'CollegeMediaController@destroy')->name('college.images.destroy');

});


/**
 * Quizzes
 */
Route::resource('quizzes', 'QuizzesController')->except(['edit', 'update']);

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

/**
 * Maps
 */
Route::post('/map/{institutionType}/{id}', 'MapsController@store')->name('map.store');

Route::patch('/map/{institutionType}/{id}', 'MapsController@update')->name('map.update');

