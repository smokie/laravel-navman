<?php

namespace Smokie\LaravelNavMan\Console\Commands;

use Illuminate\Support\Facades\Cache;

/**
 * Class AddMenu
 * @package App\Console\Commands
 */
class ClearCache extends MenuAbstract
{
    /**
     * @var string
     */
    protected $signature = 'navman:cache';

    /**
     * @var string
     */
    protected $description = 'Clear navigation menu cache';

    /**
     * @return mixed
     */
    public function handle()
    {
        Cache::forget(config('navman.cache.key'));
    }
}
