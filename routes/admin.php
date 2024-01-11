<?php

use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;


//region CKFinder
Route::any('file_browser/connector', '\CKSource\CKFinderBridge\Controller\CKFinderController@requestAction')->name('ckfinder_connector')->middleware(\App\Http\Middleware\EnsureUserIsAdmin::class);
Route::any('file_browser/browser', '\CKSource\CKFinderBridge\Controller\CKFinderController@browserAction')->name('ckfinder_browser')->middleware(\App\Http\Middleware\EnsureUserIsAdmin::class);
//endregion

Route::name('admin.')->namespace('Admin')->group(function (Router $router) {
    $router->get('/', function () {
        return abort('404');
    });

    $router->get('login/2659', 'Auth\LoginController@showLoginForm')->name('login');
    $router->post('login/2659', 'Auth\LoginController@login')->name('login.post');
    $router->post('logout', 'Auth\LoginController@logout')->name('logout');
    $router->get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
    $router->post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
    $router->get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
    $router->post('password/reset', 'Auth\ResetPasswordController@reset')->name('password.update');
    $router->get('password/reset', '\App\Http\Controllers\ResetPasswordController@showResetForm')->name('password.res');
    $router->post('login/reset', '\App\Http\Controllers\ResetPasswordController@resetLogin')->name('login.reset_login');
    $router->post('password/reset-password', '\App\Http\Controllers\ResetPasswordController@resetPassword')->name('password.reset_password');
    $router->get('password/confirm', 'Auth\ConfirmPasswordController@showConfirmForm')->name('password.confirm');
    $router->post('password/confirm', 'Auth\ConfirmPasswordController@confirm');
    $router->get('email/verify', 'Auth\VerificationController@show')->name('verification.notice');
    $router->get('email/verify/{id}/{hash}', 'Auth\VerificationController@verify')->name('verification.verify');
    $router->post('email/resend', 'Auth\VerificationController@resend')->name('verification.resend');

    Route::middleware(\App\Http\Middleware\EnsureUserIsAdmin::class)->group(function (Router $router) {
        /** Database */
        Route::prefix('database')->name('database.')->group(function (Router $router) {
            $c = 'DatabaseController@';
            $router->get('', $c . 'index')->name('index');
        });


        /** Database */
        /** New Routes */
        require __DIR__.'/admin/dashboard/dashboard.php';
        require __DIR__.'/admin/languages/language.php';
        require __DIR__.'/admin/pages/page.php';
        require __DIR__.'/admin/gallery/gallery.php';
        require __DIR__.'/admin/file/file.php';
        require __DIR__.'/admin/videos/videos.php';
        require __DIR__.'/admin/administrators/administrator.php';
        require __DIR__.'/admin/news/news.php';
        require __DIR__.'/admin/services/service.php';
        require __DIR__.'/admin/prices/price.php';
        require __DIR__ . '/admin/departmentsInformation/departmentsInformation.php';
        require __DIR__ . '/admin/doctors/doctors.php';
        require __DIR__ . '/admin/departments/departments.php';
        require __DIR__ . '/admin/policy/policy.php';
        require __DIR__ . '/admin/job/job.php';
        require __DIR__ . '/admin/question/question.php';
        require __DIR__.'/admin/slider/slider.php';
        require __DIR__.'/admin/socials/socials.php';
        require __DIR__.'/admin/patient/patient.php';
        require __DIR__ . '/admin/advantages/advantages.php';
        require __DIR__.'/admin/information/information.php';
        require __DIR__.'/admin/messages/messages.php';
        require __DIR__.'/admin/queuing_message/queuing_message.php';
        require __DIR__.'/admin/time/time.php';
        require __DIR__ . '/admin/directorate/directorate.php';
        require __DIR__ . '/admin/directorate2/directorate2.php';
        require __DIR__ . '/admin/applyJobs/applyJobs.php';
        require __DIR__ . '/admin/notificationText/notificationText.php';
        require __DIR__. '/admin/queuing_statuses/queuing_statuses.php';
        require __DIR__. '/admin/users/users.php';
    });
});
