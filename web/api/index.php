<?php

use Symfony\Component\HttpFoundation\JsonResponse;
use Nice\Application;
use Nice\Router\RouteCollector;

require __DIR__ . '/../../vendor/autoload.php';

// Enable Symfony debug error handlers
Symfony\Component\Debug\Debug::enable();

$app = new Application('dev', true, false);

// Configure your routes
$app->set('routes', function (RouteCollector $r) {
    $r->addRoute('GET', '/posts.json', function () {
        return new JsonResponse(json_decode('[
  {
    "uid": 1,
    "text" : "Have you heard about the Web Components revolution?",
    "username" : "Eric",
    "avatar" : "images/avatar-01.svg",
    "favorite": false
  },
  {
    "uid": 2,
    "text" : "Loving this Polymer thing.",
    "username" : "Rob",
    "avatar" : "images/avatar-02.svg",
    "favorite": false
  },
    {
    "uid": 3,
    "text" : "So last year...",
    "username" : "Dimitri",
    "avatar" : "images/avatar-03.svg",
    "favorite": false
  },
  {
    "uid": 4,
    "text" : "Pretty sure I came up with that first.",
    "username" : "Ada",
    "avatar" : "images/avatar-07.svg",
    "favorite": false
  },
  {
    "uid": 5,
    "text" : "Yo, I heard you like components, so I put a component in your component.",
    "username" : "Grace",
    "avatar" : "images/avatar-08.svg",
    "favorite": false
  },
  {
    "uid": 6,
    "text" : "Centralize, centrailize.",
    "username" : "John",
    "avatar" : "images/avatar-04.svg",
    "favorite": false
  },
  {
    "uid": 7,
    "text" : "Has anyone seen my cat?",
    "username" : "Zelda",
    "avatar" : "images/avatar-06.svg",
    "favorite": false
  },
  {
    "uid": 8,
    "text" : "Decentralize!",
    "username" : "Norbert",
    "avatar" : "images/avatar-05.svg",
    "favorite": false
  }
]
'));
    });
});

// Run the application
$app->run();
