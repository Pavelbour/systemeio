<?php

use Symfony\Component\Dotenv\Dotenv;

require dirname(__DIR__).'/vendor/autoload.php';

if (method_exists(Dotenv::class, 'bootEnv')) {
    (new Dotenv())->bootEnv(dirname(__DIR__).'/.env');
}

if ($_SERVER['APP_DEBUG']) {
    umask(0000);
}

passthru(sprintf(
    'APP_ENV=%s php "%s/../bin/console" doctrine:database:create',
    $_ENV['APP_ENV'],
    __DIR__
));

passthru(sprintf(
    'APP_ENV=%s php "%s/../bin/console" -n doctrine:migration:migrate',
    $_ENV['APP_ENV'],
    __DIR__
));

passthru(sprintf(
    'APP_ENV=%s php "%s/../bin/console" -n doctrine:fixtures:load',
    $_ENV['APP_ENV'],
    __DIR__
));

