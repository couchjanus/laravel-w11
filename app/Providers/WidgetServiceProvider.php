<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Widgets\Widget;
use Blade;

class WidgetServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        // $this->app->singleton(Widget::class, function ($app) {
        //     return new Widget();
        // });
        // $this->app->singleton(Widget::class, function ($app) {
        //     return new Widget(config('widgets'));
        // });
        $this->app->singleton('widget', function ($app) {
            return new Widget(config('widgets'));
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::directive(
            'widget', function ($name) {
                return "<?php echo app('widget')->show($name); ?>";
            }
        );
        /*
        * Регистрируем каталог для хранения шаблонов виджетов
        * views\widgets
        */
        $this->loadViewsFrom(resource_path('views/widgets'), 'widgets');
    }
}
