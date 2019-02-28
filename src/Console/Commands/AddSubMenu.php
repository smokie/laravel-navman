<?php

namespace Smokie\LaravelNavMan\Console\Commands;

/**
 * Class AddSubMenu
 * @package Smokie\LaravelNavMan\Console\Commands
 */
class AddSubMenu extends MenuAbstract

{
    /**
     * @var string
     */
    protected $signature = 'navman:add-sub {key : Menu item key} {sub_key} {title} {url} {permission_key}';

    /**
     * @var string
     */
    protected $description = 'Add a sub navigation menu items';

    /**
     * @return mixed
     */
    public function handle()
    {
        parent::handle();

        if (!$this->menu->offsetExists($this->argument('key'))) {
            $this->error('Menu ' . $this->argument('key') . ' does not exist!');
            return false;
        }
        $item = $this->menu->get($this->argument('key'));

        $item['sub'] = $item['sub'] ?? [];

        $item['sub'] [$this->argument('sub_key')] = [
            'title' => $this->argument('title'),
            'url' => $this->argument('url'),
            'permission_key' => $this->argument('permission_key'),
        ];

        $this->menu->offsetSet($this->argument('key'), $item);

        $this->save();

    }
}
