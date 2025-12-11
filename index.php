<?php

require __DIR__ . '/kirby/bootstrap.php';

echo (new Kirby([
    'roots' => [
        'index'    => __DIR__,
        'base'     => __DIR__,
        'site'     => __DIR__ . '/site',
        'content'  => __DIR__ . '/content',
        'storage'  => __DIR__ . '/storage',
        'accounts' => __DIR__ . '/site/accounts',
        'cache'    => __DIR__ . '/site/cache',
        'sessions' => __DIR__ . '/site/sessions',
        'media'    => __DIR__ . '/media',
        'assets'   => __DIR__ . '/assets',
    ]
]))->render();
