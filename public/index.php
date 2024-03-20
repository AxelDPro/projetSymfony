<?php

use App\Kernel;

// <link rel="stylesheet" href="css/bootstrap.css"> Cette ligne a été commentée car elle ne fait pas partie du code PHP

require_once dirname(__DIR__).'/vendor/autoload_runtime.php';

return function (array $context) {
    return new Kernel($context['APP_ENV'], (bool) $context['APP_DEBUG']);
};

