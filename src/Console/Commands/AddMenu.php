<?php

namespace Smokie\LaravelNavMan\Console\Commands;

/**
 * Class AddMenu
 * @package App\Console\Commands
 */
class AddMenu extends MenuAbstract
{
    /**
     * @var string
     */
    protected $signature = 'navman:add {key : Menu key name} {title : Title} {url : Link Url} {icon? : Icon URL} {permission_key? : Permission key}';

    /**
     * @var string
     */
    protected $description = 'Add a navigation menu item';

    /**
     * @return mixed
     */
    public function handle()
    {
        parent::handle();
        $this->menu->put($this->argument('key'), [
            'title' => $this->argument('title'),
            'url' => $this->argument('url'),
            'icon' => $this->argument('icon'),
            'permission_key' => $this->argument('permission_key'),
        ]);
        $this->save();
    }
}
