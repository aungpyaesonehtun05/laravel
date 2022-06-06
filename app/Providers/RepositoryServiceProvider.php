<?php

namespace App\Providers;

use App\Repositories\ClassRepository;
use Illuminate\Support\ServiceProvider;
use App\Interfaces\ClassRepositoryInterface;
use App\Interfaces\StudentRepositoryInterface;
use App\Repositories\StudentRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(ClassRepositoryInterface::class, ClassRepository::class);
        $this->app->bind(StudentRepositoryInterface::class, StudentRepository::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
