<?php

//use App\Services\LanguageManager\LanguageManager;
use Illuminate\Support\Facades\Route;
use App\Services\LanguageManager\Facades\LanguageManager;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Auth;

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


 Route::get('/linkstorage', function () {
     Artisan::call('route:clear');
     Artisan::call('config:clear');
     Artisan::call('storage:link');
 });


Route::middleware('setLocale')->group(function(){

//    Route::post('login', 'Site\Auth\LoginController@login')->name('login.post');
    //Route::post('order', 'Site\ProductsController@order')->name('order');
//    Route::post('reset', 'Site\Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
//    Route::post('password/reset/{email}/{token}', 'Site\Auth\ResetPasswordController@reset')->name('password.update');
    //Route::post('send-mail', 'Site\AppController@sendMail')->name('contacts.send_mail');
});

//Route::get('basket/all', 'Site\Cabinet\BasketController@basket')->name('cabinet.basket.all');
Route::get('basket/list', 'Site\Cabinet\BasketController@getBasketItems')->name('cabinet.basket.get');
Route::post('basket/add', 'Site\Cabinet\BasketController@add')->name('session.basket.add');
Route::delete('basket/remove', 'Site\Cabinet\BasketController@destroy')->name('session.basket.destroy');

//Route::put('basket/update', 'Site\Cabinet\BasketController@update')->name('cabinet.basket.update');
//Route::delete('basket/remove', 'Site\Cabinet\BasketController@delete')->name('cabinet.basket.delete');

Route::group(['prefix' => LanguageManager::getPrefix(), 'middleware'=>\App\Http\Middleware\LanguageManager::class], function () {

    /** Auth */
    //Route::get('smallBasket/list', 'Site\Cabinet\BasketController@getSmallBasket')->name('cabinet.basket.getSmallBasket');
    Route::get('login', 'Site\Auth\LoginController@showLoginForm')->name('login');
    Route::get('reset', 'Site\Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
    Route::get('password/reset/{email}/{token}', 'Site\Auth\ResetPasswordController@showResetForm')->name('password.reset');
    /** End Auth */

    Route::get('{url?}', 'Site\StaticPagesController@pageManager')->name('page');

    Route::get('departments/get-media-items-view/{url}', 'Site\StaticPagesController@getMediaItemsView')->name('getMediaItemsView');

    Route::get('departments'.'/{url}', 'Site\StaticPagesController@departmentPage')->name('subpage');

    Route::get('doctors' . '/{url}', 'Site\MembersController@detail')->name('doctors.detail');

    Route::get('job-single' . '/{id}', 'Site\JobsController@detail')->name('job.detail');


    Route::get('management' . '/{url}', 'Site\DirectoratesController@detail')->name('management.detail');
    Route::get('administration' . '/{url}', 'Site\DirectoratesController2@detail')->name('administration.detail');


    Route::get('for-patients' . '/{url}', 'Site\PatientsController@detail')->name('patients.detail');
    Route::get('news' . '/{url}', 'Site\NewsController@detail')->name('news.detail');
    Route::get('price-list' . '/{url}', 'Site\PriceListController@detail')->name('price_list.detail');

    Route::get('department' . '/{department}/{url}', 'Site\ServicesController@detail')->name('services.detail');

    Route::get('faq' . '/{url}', 'Site\FaqsController@detail')->name('faq.detail');

    Route::get('activity' . '/{url}', 'Site\ActivityController@activity')->name('activity.detail');

    Route::get('event' . '/{url}', 'Site\EventsController@event')->name('event.detail');

    Route::get('policy/{id}', 'Site\PolicyController@download')->name('policy');

    Route::get('library/{id}', 'Site\LibraryController@download')->name('library');
    /**
     * Page forms
     */
    Route::post('queuing/send_queuing', 'Site\InnerController@sendQueuingMessage')->name('queuing.send_queuing');
    Route::post('queuing/send_queuing_with_items', 'Site\InnerController@sendQueuingMessageWithItems')->name('queuing.send_queuing_with_items');

    Route::get('search/search', 'Site\SearchController@search')->name('search.search');

    Route::post('job/apply_job', 'Site\InnerController@jobApply')->name('job.apply_job');

    Route::post('volunteering/send-message', 'Site\InnerController@sendVolunteeringMessage')
        ->name('volunteering.send_message');
    Route::post('apply/send-message', 'Site\InnerController@sendApplyMessage')
        ->name('apply.send_message');

    Route::post('contact/send-message', 'Site\InnerController@sendContactsMessage')
        ->name('contact.send_message');


});
