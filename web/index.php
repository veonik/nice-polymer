<?php

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Nice\Application;
use Nice\Router\RouteCollector;

require __DIR__ . '/../vendor/autoload.php';

// Enable Symfony debug error handlers
Symfony\Component\Debug\Debug::enable();

$app = new Application('dev', true, false);

// Configure your routes
$app->set('routes', function (RouteCollector $r) {
    $r->addRoute('GET', '/', function (Application $app, Request $request) {
        return new Response(file_get_contents(__DIR__ . '/../views/index.html'));
    });
});

// Run the application
$app->run();
