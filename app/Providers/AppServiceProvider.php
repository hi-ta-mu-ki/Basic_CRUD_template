<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
      $this->app->bind(
        \App\Repositories\User_RepositoryInterface::class,
        \App\Repositories\User_Repository::class,
      );
      $this->app->bind(
        \App\Services\User_ServiceInterface::class,
        \App\Services\User_Service::class,
      );
      $this->app->bind(
        \App\Repositories\A_master_RepositoryInterface::class,
        \App\Repositories\A_master_Repository::class,
      );
      $this->app->bind(
        \App\Services\A_master_ServiceInterface::class,
        \App\Services\A_master_Service::class,
      );
      $this->app->bind(
        \App\Repositories\B_master_RepositoryInterface::class,
        \App\Repositories\B_master_Repository::class,
      );
      $this->app->bind(
        \App\Services\B_master_ServiceInterface::class,
        \App\Services\B_master_Service::class,
      );
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
      Paginator::useBootstrap();
    }
}
