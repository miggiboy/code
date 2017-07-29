<?php

/**
 * Home
 */

Route::get('', 'User\MessagesController@index')->name('home');

/**
 * User
 */

Route::group(['namespace' => 'User'], function () {

    /**
     * Users
     */

    Route::delete('users/{user}', 'UsersController@destroy')->name('users.destroy');

    /**
     * Registration
     */
    Route::get('register', 'RegistrationController@create')->name('registration.create');
    Route::post('register', 'RegistrationController@store')->name('registration.store');

    /**
     * Sessions
     */
    Route::get('/login', 'SessionsController@create')->name('login');
    Route::post('/login', 'SessionsController@store')->name('session.store');

    Route::get('/logout', 'SessionsController@destroy')->name('logout');

    /**
     * Feed messages
     */
    Route::post('/message', 'MessagesController@store')->name('messages.store');

    /**
     * Profile
     */

    Route::get('/profile', 'ProfileController@show')->name('profile.show');

    Route::get('/profile/edit', 'ProfileController@edit')->name('profile.edit');
    Route::patch('/profile', 'ProfileController@update')->name('profile.update');

    /**
     * Markers
     */
    Route::post('/markers/{markableType}/{markableId}', 'MarkersController@store')->name('markers.store');
    Route::delete('/markers/{markableType}/{markableId}', 'MarkersController@destroy')->name('markers.destroy');

    /**
     * Team Members
     */
    Route::resource('team-members', 'TeamMembersController', [
        'only' => ['index', 'create']
    ]);

    /**
     * User Roles
     */
    Route::resource('users.roles', 'UserRolesController', [
        'only' => ['store', 'destroy']
    ]);

    /**
     * User Active Status
     */

    Route::patch('/users/{user}/active-status', 'UserActiveStatusesController@update')->name('users.active-status.update');
});


/**
* Specialties
*/

Route::group(['namespace' => 'Specialties'], function () {

    Route::group(['prefix' => '/{institutionType}-specialties'], function () {

        /**
         * Real-time dropdown search
         */
        Route::get('/rt-search', 'SpecialtiesController@rtSearch');

        Route::get('', 'SpecialtiesController@index')->name('specialties.index');

        Route::get('/create', 'SpecialtiesController@create')->name('specialties.create');
        Route::post('', 'SpecialtiesController@store')->name('specialties.store');

        Route::get('/{specialty}/edit', 'SpecialtiesController@edit')->name('specialties.edit');
        Route::patch('/{specialty}', 'SpecialtiesController@update')->name('specialties.update');

        Route::get('/{specialty}', 'SpecialtiesController@show')->name('specialties.show');

        Route::delete('/{specialty}', 'SpecialtiesController@destroy')->name('specialties.destroy');
    });

    /**
     * Specialty Professions
     */
    Route::resource('specialties.professions', 'SpecialtyProfessionsController', ['except' => ['show']]);

    /**
     * Specialty qualifications
     */
    Route::resource('specialties.qualifications', 'SpecialtyQualificationsController', [
        'except' => ['show', 'edit', 'update']
    ]);

    /**
     * Specialty institutions
     */
    Route::resource('specialties.institutions', 'SpecialtyInstitutionsController', [
        'only' => ['index']
    ]);

    Route::patch('/specialies/{specialty}/type', 'SpecialtyTypesController@update')->name('specialties.types.update');
});


/**
 * Qualifications
 */

Route::group(['namespace' => 'Specialties\Qualifications'], function () {

    Route::resource('qualifications', 'QualificationsController');

    /**
     * Qualification Colleges
     */
    Route::resource('qualifications.colleges', 'QualificationCollegesController', [
        'only' => ['index']
    ]);
});


/**
 * Professions
 */

Route::group(['namespace' => 'Professions'], function () {

    /**
     * Real-time dropdown search
     */

    Route::get('professions/rt-search', 'ProfessionsController@rtSearch');

    Route::resource('professions', 'ProfessionsController');

    /**
     * Profession Specialties
     */
    Route::resource('professions.specialties', 'ProfessionSpecialtiesController', [
        'except' => ['edit', 'update', 'show']
    ]);
});


/**
 * Subjects
 */

Route::group(['namespace' => 'Subjects'], function () {

    Route::resource('subjects', 'SubjectsController', [
        'except' => ['edit', 'update']
    ]);

    // Subject Media
    Route::resource('subjects.media', 'SubjectMediaController', [
        'only' => ['index', 'store', 'destroy']
    ]);

    Route::resource('subjects.specialties', 'SubjectSpecialtiesController', [
        'only' => ['index']
    ]);
});


// Cities
Route::resource('cities', 'CitiesController', [
    'only' => ['index', 'store', 'destroy']
]);

/**
 * Institutions
 */

Route::group(['namespace' => 'Institution', 'prefix' => '/institutions'], function () {

    /**
     * Institution Paid Status
     */
    Route::patch('/{institution}/paid-status', 'InstitutionPaidStatusController@update')->name('institutions.paid-status.update');

    /**
     * Institutions
     */

    Route::group(['prefix' => '/{institutionType}'], function () {

        /**
         * Real-time dropdown search
         */
        Route::get('/rt-search', 'InstitutionsController@rtSearch');

        Route::get('', 'InstitutionsController@index')->name('institutions.index');

        Route::get('/create', 'InstitutionsController@create')->name('institutions.create');
        Route::post('', 'InstitutionsController@store')->name('institutions.store');

        Route::get('/{institution}/edit', 'InstitutionsController@edit')->name('institutions.edit');
        Route::patch('/{institution}', 'InstitutionsController@update')->name('institutions.update');

        Route::delete('/{institution}', 'InstitutionsController@destroy')->name('institutions.destroy');

        Route::get('/{institution}', 'InstitutionsController@show')->name('institutions.show');
    });

    /**
     * Institution Specialties
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
     * Institution Qualifications
     */

    Route::group(['prefix' => '/{institution}/qualifications/{studyForm}'], function () {
        Route::get('', 'InstitutionQualificationsController@index')->name('institutions.qualifications.index');

        Route::get('/create', 'InstitutionQualificationsController@create')->name('institutions.qualifications.create');
        Route::post('', 'InstitutionQualificationsController@store')->name('institutions.qualifications.store');

        Route::get('/edit', 'InstitutionQualificationsController@edit')->name('institutions.qualifications.edit');
        Route::patch('', 'InstitutionQualificationsController@update')->name('institutions.qualifications.update');

        Route::delete('/{specialty}', 'InstitutionQualificationsController@destroy')->name('institutions.qualifications.destroy');
    });

    /**
     * Institution Media
     */

    Route::post('/{institution}/media', 'InstitutionMediaController@store')->name('institutions.media.store');

    Route::delete('/media/{media}/destroy', 'InstitutionMediaController@destroy');

    /**
     * Institution Logo
     */
    Route::patch('/{institution}/logos/{image}', 'InstitutionLogosController@update');

    /**
     * Institution Maps
     */
    Route::post('/{institution}/map', 'InstitutionMapsController@store')->name('institutions.maps.store');
    Route::patch('/{institution}/map', 'InstitutionMapsController@update')->name('institutions.maps.update');
});

/**
 * Quizzes
 */
Route::resource('quizzes', 'QuizzesController', [
    'except' => ['edit', 'update']
]);

Route::post('/quizzes/preview', 'QuizzesController@preview')->name('quizzes.preview');

Route::post('/answer/{answerId}', 'QuizzesController@check')->name('answer.check');

/**
 * Articles
 */

Route::resource('articles', 'ArticlesController');
