<?php

namespace App\Providers;

use App\Repositories\PostRepositoryInterface;
use App\Repositories\PostRepository;
use App\Repositories\CategoryRepositoryInterface;
use App\Repositories\CategoryRepository;
// REPOS USE
use Illuminate\Support\ServiceProvider;

class PowerProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        
        $this->app->bind(
            PostRepositoryInterface::class,
            PostRepository::class
        );

        $this->app->bind(
            CategoryRepositoryInterface::class,
            CategoryRepository::class
        );
// REPOS BIND END
    }
}
