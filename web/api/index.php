<?php

use Nice\Extension\DoctrineDbalExtension;
use Symfony\Component\HttpFoundation\JsonResponse;
use Nice\Application;
use Nice\Router\RouteCollector;
use Symfony\Component\HttpFoundation\Request;

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

        $results = array_map(function($result) {
            $result['favorite'] = (bool) $result['favorite'];

            return $result;
        }, $results);

        return new JsonResponse($results);
    });

    $r->addRoute('POST', '/post/{id}/update.json', function (Application $app, Request $request, $id) {
        $conn = $app->get('doctrine.dbal.database_connection');
        $favorite = $request->get('favorite', 'false');
        $conn->executeQuery('UPDATE messages SET favorite = :favorite WHERE uid = :id', array(
            'favorite' => $favorite === "true" ? 1 : 0,
            'id' => $id
        ));

        return new JsonResponse();
    });
});

// Run the application
$app->run();
