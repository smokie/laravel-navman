<?php

namespace Smokie\LaravelNavMan\Console\Commands;

/**
 * Class AddMenu
 * @package App\Console\Commands
 */
class RemoveMenu extends MenuAbstract
{
    /**
     * @var string
     */
    protected $signature = 'navman:remove {key : Menu key name}';

    /**
     * @var string
     */
    protected $description = 'Remove a navigation menu item';

    /**
     * @return mixed
     */
    public function handle()
    {
        parent::handle();
        $this->menu->offsetUnset($this->argument('key'));
        $this->save();
    }
}
