<?php
namespace Yoan1005\Abonews;

use Illuminate\Support\ServiceProvider;

class AbonewsServiceProvider extends ServiceProvider
{
  /**
  * Perform post-registration booting of services.
  *
  * @return void
  */
  public function boot()
  {

    $this->loadViewsFrom(__DIR__.'/resources/views', 'abonews');
    $this->loadMigrationsFrom(__DIR__.'/database/migrations');

    $this->app['router']->aliasMiddleware('Admin', Middleware\Admin::class);

    $this->app['router']->namespace('Yoan1005\\Abonews\\Controllers')
    ->middleware(['web'])
    ->group(function () {
      $this->loadRoutesFrom(__DIR__ . '/routes/web.php');
    });

    if ($this->app->runningInConsole()) {
      $this->bootForConsole();
    }
  }

  /**
  * Register any package services.
  *
  * @return void
  */
  public function register()
  {
    $this->mergeConfigFrom(__DIR__.'/config/abonews.php', 'abonews');
  }

  /**
  * Get the services provided by the provider.
  *
  * @return array
  */
  public function provides()
  {
    return ['abonews'];
  }

  /**
  * Console-specific booting.
  *
  * @return void
  */
  protected function bootForConsole()
  {
    $this->publishes([
      __DIR__.'/config/abonews.php' => config_path('abonews.php'),
    ], 'abonews.config');

    $this->publishes([
      __DIR__.'/resources/views' => base_path('resources/views/vendor/abonews'),
    ], 'abonews.views');

    $this->publishes([
      __DIR__ . '/public/assets/' => public_path('vendor/abonews'),
    ], 'public');


    $this->publishes([
      __DIR__.'/database/migrations' => base_path('database/migrations'),
    ], 'abonews.migrations');
  }
}
