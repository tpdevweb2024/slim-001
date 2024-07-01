<?php

use Slim\Factory\AppFactory;
use Slim\Views\TwigMiddleware;
use Slim\Views\Twig;

require __DIR__ . "/../vendor/autoload.php";

// On instancie l'application principale de notre projet
$app = AppFactory::create();

// Create Twig
$twig = Twig::create('../src/views', ['cache' => false]);
// Add Twig-View Middleware
$app->add(TwigMiddleware::create($app, $twig));

require "../src/routes/routing.php";

// On lance l'application $app
$app->run();
