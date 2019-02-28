<?php
/**
 * Created by PhpStorm.
 * User: taherodeh
 * Date: 11/12/2018
 * Time: 0:51
 */

namespace Smokie\LaravelNavMan\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\File;

/**
 * Class MenuAbstract
 * @package App\Console\Commands
 */
abstract class MenuAbstract extends Command
{
    /**
     * @var Collection
     */
    protected $menu;

    static private $path;

    /**
     * MenuAbstract constructor.
     * @throws \Exception
     */
    public function __construct()
    {
        parent::__construct();

        self::$path = resource_path(config('navman.filename'));

        $this->menu = collect();

        if (!File::exists(self::$path)) {
            File::put(self::$path, '{}');
        }
    }

    public function handle()
    {
        if (!app('files')->exists(self::$path)) {
            // create menu file

            app('files')->put(self::$path, $this->menu->toJson());
        }

        $this->menu = collect(json_decode(app('files')->get(self::$path), true));
    }

    /**
     * @return bool
     */
    protected function save(): bool
    {
        return app('files')->put(self::$path, $this->menu->toJson()) > -1;
    }

}