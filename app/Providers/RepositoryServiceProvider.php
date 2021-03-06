<?php namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
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
        $this->app->bind(\App\Repositories\Interfaces\UserInterface::class, \App\Repositories\Eloquent\UserRepository::class);
        $this->app->bind(\App\Repositories\Interfaces\EventInterface::class, \App\Repositories\Eloquent\EventRepository::class);
    }
}
