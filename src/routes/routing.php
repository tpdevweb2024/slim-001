<?php

use Slim\Views\Twig;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

// On va configurer les paramètres de $app
$app->get("/", function (Request $request, Response $response) {
    $view = Twig::fromRequest($request);
    return $view->render($response, 'home.html', [
        'linkcss' => "//" . $_SERVER["HTTP_HOST"] . "/style.css"
    ]);
});

$app->get("/about", function (Request $request, Response $response) {
    $view = Twig::fromRequest($request);
    return $view->render($response, 'about.html', [
        'linkcss' => "//" . $_SERVER["HTTP_HOST"] . "/style.css"
    ]);
});

// On va récupérer des arguments passés en url grâce aux accolades, qui précise le nom
// de la clé à récupérer
$app->get("/hello/{name}", function (Request $request, Response $response, $args) {
    $view = Twig::fromRequest($request);
    $blabla = "Coucou";
    return $view->render($response, 'hello.html', [
        'name' => $args['name'],
        'blabla' => $blabla,
        'linkcss' => "//" . $_SERVER["HTTP_HOST"] . "/style.css"
    ]);
});
