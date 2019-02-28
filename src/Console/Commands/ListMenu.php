<?php

namespace Smokie\LaravelNavMan\Console\Commands;

/**
 * Class ListMenu
 * @package Smokie\LaravelNavMan\Console\Commands
 */
class ListMenu extends MenuAbstract
{
    /**
     * @var string
     */
    protected $signature = 'navman:list';

    /**
     * @var string
     */
    protected $description = 'List navigation menu items';

    /**
     * @return mixed
     */
    public function handle()
    {
        parent::handle();

        $headers = [
            'key',
            'title',
            'url',
            'permission_key',
            'icon',
        ];

        $rows = collect();
        $this->menu->each(function ($item, $key) use ($rows, $headers) {

            $row = collect($item)->except('sub')->toArray();
            $row['key'] = $key;
            uksort($row, function ($a, $b) use ($headers) {
                return array_search($a, $headers) > array_search($b, $headers) ? 1 : -1;
            });

            $rows->push($row);

            if ($item['sub'] ?? false) {
                collect($item['sub'])->each(function ($sub, $skey) use ($key, $rows, $headers) {
                    $sub['icon'] = '-';
                    $sub['key'] = implode(".", [$key, $skey]);

                    uksort($sub, function ($a, $b) use ($headers) {
                        return array_search($a, $headers) > array_search($b, $headers) ? 1 : -1;
                    });

                    $rows->push($sub);
                });
            }

        });


        $this->table($headers, $rows);

    }
}
