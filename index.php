<?php

// Create and bind the DI to the application
require_once('config/services.php');

$app->get(
    "/",
    function () {
        throw new \Exception("An error");
    }
);

$app->error(
    function ($exception) {
        echo $exception;
    }
);

$app->notFound(
    function () use ($app) {
        $app->response->setStatusCode(404, "Not Found");

        $app->response->sendHeaders();

        echo "This is crazy, but this page was not found!";
    }
);

$app = loadRoute("Controllers\UsersController", 'users', $app);
$app = loadRoute("Controllers\PostsController", 'posts', $app);

$app->get(
    "/say/welcome/{name}",
    function ($name) {
        echo "<h1>Welcome $name!</h1>";
    }
);

// // Retrieves all robots
// $app->get(
//     "/api/robots",
//     function () use ($app) {
//         $users = users::find();

//         foreach ($users as $user) {
//             $data[] = [
//                 "id"   => $user->id,
//                 "name" => $user->name,
//             ];
//         }

//         echo json_encode($data);
//     }
// );

$app->handle();
