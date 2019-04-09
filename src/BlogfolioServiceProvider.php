<?php

namespace Ukadev\Blogfolio;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\ServiceProvider;
use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\Facades\Schema;

class BlogfolioServiceProvider extends ServiceProvider
{
    protected $redirectPath = '/panel';
    protected $commands = [
        'Ukadev\Blogfolio\Commands\InstallCommand',
        'Ukadev\Blogfolio\Commands\ReinstallCommand'
    ];

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot(\Illuminate\Routing\Router $router)
    {
        Schema::defaultStringLength(191);
        //load required resources
        $this->loadViewsFrom(__DIR__ . '/Views', 'blogfolio');
        $this->loadMigrationsFrom(__DIR__ . '/Migrations');
        $this->loadTranslationsFrom(__DIR__ . '/Translations', 'blogfolio');
        // publish resources
        //$this->publishes([__DIR__ . '/Views' => resource_path('views/vendor/blogfolio')]);
        $this->publishes([__DIR__ . '/../public' => public_path('vendor/blogfolio')]);
        $this->publishes([__DIR__ . '/Seeds' => app_path('/../database/seeds')]);

        // load routes
        $this->app->booted(function () {
            include __DIR__ . '/Routes.php';
        });

        //register the locale middleware
        $router->pushMiddlewareToGroup('web', \Ukadev\Blogfolio\Middleware\Language::class);
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        // Set the blogfolio commands
        $this->commands($this->commands);
    }
}