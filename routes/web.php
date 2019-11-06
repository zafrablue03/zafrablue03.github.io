<?php
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



// Fronted

Route::resource('reservations', 'Frontend\Reservation\ReservationsController');
Route::get('reservation', 'Frontend\Reservation\ReservationsController@index')->name('reservation');
Route::get('/', 'Frontend\HomepageController@index')->name('home');

Route::get('/gallery', function(){
    return view('pages.frontend.eventsGallery.index');
})->name('gallery');



Auth::routes([
    'register' => 'false',
]);

// Route::get('/home', 'HomeController@index')->name('home');



// Backend

Route::group( ['prefix' => 'admin', 'middleware' => ['auth','admin'], ], function(){

    Route::get('index', 'AdminController@admin')
    ->name('admin');

    Route::resource('types', 'Backend\Type\TypesController');
    // ->except('create','store', 'destroy')
    Route::resource('courses', 'Backend\Course\CourseController');
    Route::resource('settings', 'Backend\Setting\SettingsController');
    Route::resource('inclusions', 'Backend\Inclusion\InclusionsController');
    Route::resource('features', 'Backend\Feature\FeaturesController')->except(['show']);
    Route::resource('services', 'Backend\Service\ServicesController');
    Route::resource('reservation', 'Backend\Reservation\ReservationsController');
    Route::resource('profile', 'Backend\Profile\ProfileController')->parameters(['profile' => 'user']);

    Route::get('contract/{reservation}', 'Backend\Reservation\ReservationsController@streamPDF')->name('reservation.pdf');

    Route::get('reservation/{reservation}/payable', 'Backend\Payable\PayablesController@create')->name('payable.create');
    Route::post('reservation/{reservation}/payable', 'Backend\Payable\PayablesController@store')->name('payable.store');

    Route::resource('gallery', 'Backend\Gallery\GalleriesController')->except(['show', 'edit', 'create', 'update'])->parameters(['gallery' => 'image']);

    //Admin add staff
    Route::post('add-staff', 'Backend\Users\UsersController@addStaff')->name('add.staff');
    Route::delete('delete-staff/{user}', 'Backend\Users\UsersController@destroy')->name('delete.staff');
    //Admin feature user to team
    Route::post('feature-to-team/{user}','Backend\Users\UsersController@featureStaff')->name('feature.staff');


    //Revenue

    Route::get('revenue/{month}', 'AdminController@get_dynamic_revenue_using_ajax')->name('revenue');


    // AJAX
    // Route::get('pending', 'Backend\Reservation\ReservationsController@notify_pending')->name('pending');
    Route::get('chart-data', 'Backend\AjaxDataController@all-data')->name('chart.data');
    Route::get('services-data/{month}', 'Backend\AjaxDataController@get_services_data_sales_per_month')->name('services.data');
    Route::post('datetime', 'Backend\Setting\SettingsController@newDateTime')->name('datetime.add');
    Route::delete('datetime/{datetime}', 'Backend\Setting\SettingsController@deleteDateTime')->name('datetime.delete');



    

});
