<?php

namespace App\Providers;

use App\Models\Volunteering;
use App\Observers\Frontend\VolunteeringObserver;
use App\Services\ImageUploader\Drivers\ImageDriver;
use App\Services\ImageUploader\Drivers\StorageDriver;
use App\Services\ImageUploader\Uploader;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(ImageDriver::class, function ($app) {
            return ImageDriver::instance();
        });

        $this->app->bind(StorageDriver::class, function ($app) {
            return StorageDriver::instance();
        });

        $this->app->bind('imageUploader', function ($app) {
            return new Uploader(ImageDriver::instance(), StorageDriver::instance(), []);
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //Schema::defaultStringLength(191);
    }
}
