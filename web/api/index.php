<?php

use Nice\Extension\DoctrineDbalExtension;
use Symfony\Component\HttpFoundation\JsonResponse;
use Nice\Application;
use Nice\Router\RouteCollector;

require __DIR__ . '/../../vendor/autoload.php';

// Enable Symfony debug error handlers
Symfony\Component\Debug\Debug::enable();

$app = new Application('dev', true, false);
$app->appendExtension(new DoctrineDbalExtension(array(
  'database' => array(
    'driver' => 'pdo_sqlite',
    'path' => '%app.root_dir%/sqlite.db'
))));

// Configure your routes
$app->set('routes', function (RouteCollector $r) {
    $r->addRoute('GET', '/posts.json', function (Application $app) {
        $conn = $app->get('doctrine.dbal.database_connection');

        $results = $conn->executeQuery("SELECT * FROM messages")->fetchAll();

        return new JsonResponse($results);
    });
});

// Run the application
$app->run();
