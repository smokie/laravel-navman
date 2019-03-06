<?php
/**
 * Created by PhpStorm.
 * User: taherodeh
 * Date: 10/01/2019
 * Time: 22:35
 */

namespace Smokie\LaravelNavMan;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\File;
use Smokie\LaravelNavMan\Console\Commands\AddMenu;
use Smokie\LaravelNavMan\Console\Commands\AddSubMenu;
use Smokie\LaravelNavMan\Console\Commands\ClearCache;
use Smokie\LaravelNavMan\Console\Commands\ListMenu;
use Smokie\LaravelNavMan\Console\Commands\RemoveMenu;
use Smokie\LaravelNavMan\Console\Commands\RemoveSubMenu;
use Illuminate\Support\ServiceProvider;

/**
 * Class CrudzServiceProvider
 * @package Smokie\LaravelNavMan
 */
class LaravelNavManServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../config/navman.php' => config_path('navman.php')
        ]);

        $this->commands([
            AddMenu::class,
            AddSubMenu::class,
            ListMenu::class,
            RemoveMenu::class,
            RemoveSubMenu::class,
            ClearCache::class,
        ]);
    }

    public function register()
    {
        $this->app->singleton('navman', function ($app) {

            $path = resource_path(config('navman.filename'));

            if (Cache::has(config('navman.cache.key'))) {
                return collect(Cache::get(config('navman.cache.key')));
            }

            $items = File::exists($path) ?
                json_decode(File::get($path)) :
                [];

            Cache::put(config('navman.cache.key'), $items, config('navman.cache.ttl'));

            return collect($items);
        });
    }
}