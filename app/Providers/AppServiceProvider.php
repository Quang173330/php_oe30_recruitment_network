<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\Job\JobRepositoryInterface;
use App\Repositories\Job\JobRepository;
use App\Repositories\Tag\TagRepositoryInterface;
use App\Repositories\Tag\TagRepository;

class AppServiceProvider extends ServiceProvider
{
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
        $this->app->singleton(
            TagRepositoryInterface::class,
            TagRepository::class
        );
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        
    }
}
