<?php

use Phalcon\Loader;
use Phalcon\Mvc\Micro;
use Phalcon\Db\Adapter\Pdo\Mysql as PdoMysql;
use Phalcon\Di\FactoryDefault;
use Phalcon\Mvc\Micro\Collection as MicroCollection;

require_once('error_handler.php');

// Use Loader() to autoload our model
$loader = new Loader();

// $loader->registerDirs(
//     [
//         __DIR__ . "/models/"
//     ]
// )->register();

// Register namespaces
$loader->registerNamespaces(
    array(
        'Controllers' => 'controllers',
        'models' => 'models'
    )
)->register();

function loadRoute( $ctrlName, $prefix, $app )
{    
    $data = new MicroCollection();    
    // Set the main handler. ie. a controller instance
    $data->setHandler( $ctrlName, true);
    // Set a common prefix for all routes
    $data->setPrefix("/api/".$prefix);
    // Use the method 'index' in PostsController
    $data->get("/", "index");
    // Mount
    $app->mount($data);

    return $app;
}

$di = new FactoryDefault();

// Set up the database service
$di->set(
    "db",
    function () {
        return new PdoMysql(
            [
                "host"     => "localhost",
                "username" => "root",
                "password" => "12345",
                "dbname"   => "dreamTourAtas",
            ]
        );
    }
);

// Create and bind the DI to the application
$app = new Micro($di);