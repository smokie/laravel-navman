<?php

namespace Smokie\LaravelNavMan\Console\Commands;

use Illuminate\Support\Arr;

/**
 * Class RemoveSubMenu
 * @package Smokie\LaravelNavMan\Console\Commands
 */
class RemoveSubMenu extends MenuAbstract
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'navman:remove-sub {key : Menu item key} {sub_key : Submenu item key}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Remove a sub navigation menu item';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        parent::handle();

        if (!Arr::exists($this->menu, $this->argument('key'))) {
            $this->error('Menu ' . $this->argument('key') . ' does not exist!');
            return false;
        }

        if (!Arr::exists($this->menu[$this->argument('key')]['sub'], $this->argument('sub_key'))) {
            $this->error('Submenu ' . $this->argument('sub_key') . ' does not exist!');
            return false;
        }

        $arr = $this->menu->toArray();

        unset($arr[$this->argument('key')]['sub'][$this->argument('sub_key')]);

        $this->menu = collect($arr);

        $this->save();

    }
}
