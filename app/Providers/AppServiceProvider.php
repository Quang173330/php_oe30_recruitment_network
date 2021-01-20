<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\Job\JobRepositoryInterface;
use App\Repositories\Job\JobRepository;

class AppServiceProvider extends ServiceProvider
{
        /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(
            JobRepositoryInterface::class,
            JobRepository::class
        );
    }


}
