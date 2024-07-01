<?php


use Slim\Views\Twig;
use Slim\Views\TwigMiddleware;
use Slim\Factory\AppFactory;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

require __DIR__ . "/../vendor/autoload.php";

// On instancie l'application principale de notre projet
$app = AppFactory::create();

// Create Twig
$twig = Twig::create('../src/views', ['cache' => false]);
// Add Twig-View Middleware
$app->add(TwigMiddleware::create($app, $twig));

// On va configurer les paramètres de $app
$app->get("/", function (Request $request, Response $response) {
    $response->getBody()->write("coucou");
    return $response;
});

$app->get("/about", function (Request $request, Response $response) {

    include "./../src/models/usersList.php";

    $data = "<ul class='ulList'>";
    foreach ($users as $user) {
        $data .= "<li class='liType'>" . $user[0] . "</li>";
    }
    $data .= "</ul>";

    $response->getBody()->write($data);
    return $response;
});


$app->get("/contact", function (Request $request, Response $response) {
    $response->getBody()->write("<h1>Contact Page</h1>");
    return $response;
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

// On lance l'application $app
$app->run();
