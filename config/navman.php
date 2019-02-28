<?php


return [
    'filename' => env('NAVMAN_FILENAME', 'menu.json'),

    'cache' => [
        'key' => env('NAVMAN_CACHE_KEY', '__navman__'),
        'cache_ttl' => env('NAVMAN_CACHE_TTL', 1728000),
    ]
];