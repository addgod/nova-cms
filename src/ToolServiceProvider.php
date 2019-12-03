<?php

namespace Addgod\NovaCms;

use Addgod\NovaCms\Commands\NovaCmsPagePublish;
use Addgod\NovaCms\Http\Middleware\Locale;
use Addgod\NovaCms\Models\Page as ModelPage;
use App\Nova\Page;
use App\Nova\Resource;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

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

        View::composer('nova-cms::partials.navigation', function ($view) {
            $pages = ModelPage::whereStatus(ModelPage::LIVE)->get();
            $view->with('menus', $pages);
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

        if (class_exists(Page::class) && isset(Resource::$locales)) {
            $route = Route::middleware(['web', Locale::class])->namespace('Addgod\NovaCms\Http\Controllers');
            if (count(Resource::$locales) > 1) {
                $route
                    ->prefix('{locale}')
                    ->where(['locale' => implode('|', Resource::$locales)]);

                Route::get('/', function () {
                    return redirect()->route('page.show', ['locale' => config('app.locale')], 301);
                });
            }
            $route->group(__DIR__ . '/../routes/web.php');
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
