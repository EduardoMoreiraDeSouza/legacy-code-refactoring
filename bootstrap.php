<?php

session_start();
require_once __DIR__.'/vendor/autoload.php';
require_once __DIR__.'/config/config.inc.php';

$config = ['settings' => [
        'displayErrorDetails' => true
    ]
];

$app = new \Slim\App($config);

require_once __DIR__.'/routes/web.php';

$app->run();