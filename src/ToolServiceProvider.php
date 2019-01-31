<?php

namespace Addgod\NovaCms;

use Addgod\NovaCms\Commands\NovaCmsPagePublish;
use Addgod\NovaCms\Http\Middleware\Authorize;
use Addgod\NovaCms\Http\Middleware\Locale;
use App\Nova\Page;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Infinety\Filemanager\FilemanagerTool;
use Laravel\Nova\Events\ServingNova;
use Laravel\Nova\Nova;

class ToolServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'nova-cms');
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');

        $this->publishes([
            __DIR__ . '/../publishes/Page.php' => app_path('Nova/Page.php'),
            __DIR__ . '/../resources/views'    => resource_path('views/vendor/nova-cms'),
        ]);

        if ($this->app->runningInConsole()) {
            $this->commands([
                NovaCmsPagePublish::class,
            ]);
        }

        $this->app->booted(function () {
            $this->routes();
        });

        Nova::serving(function (ServingNova $event) {
            Nova::tools([
                new FilemanagerTool(),
            ]);
        });
    }

    /**
     * Register the tool's routes.
     *
     * @return void
     */
    protected function routes()
    {
        if ($this->app->routesAreCached()) {
            return;
        }

        Route::middleware(['nova', Authorize::class])
            ->prefix('nova-vendor/nova-cms')
            ->group(__DIR__ . '/../routes/api.php');

        if (class_exists(Page::class)) {
            Route::middleware(['web', Locale::class])
                ->prefix('{locale}')
                ->where(['locale' => implode('|', Page::$locales)])
                ->group(__DIR__ . '/../routes/web.php');

            Route::get('/', function () {
                return redirect()->route('page.show', ['locale' => Page::$defaultLocale], 301);
            });
        }
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
