<?php

declare(strict_types=1);

require __DIR__ . DIRECTORY_SEPARATOR . 'vendor/autoload.php';

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

$request = Laminas\Diactoros\ServerRequestFactory::fromGlobals(
    $_SERVER,
    $_GET,
    $_POST,
    $_COOKIE,
    $_FILES
);

$router = new League\Route\Router();


// map a route
$router->map('GET', '/', function (ServerRequestInterface $request): ResponseInterface {
    $response = new Laminas\Diactoros\Response();

    // check if the connection is valid
    if (Source\Core\Connect::getInstance()) {
        $response->getBody()->write('<h1>Hello, World! Conectado ao BD com successo!</h1>');
    } else {
        $response->getBody()->write('<h1>Ooops... Falha ao conectar ao BD</h1>');
    }
    return $response;
});

$response = $router->dispatch($request);

// send the response to the browser
(new Laminas\HttpHandlerRunner\Emitter\SapiEmitter())->emit($response);
