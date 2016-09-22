<?php
namespace Controllers;

use models\users;
use Phalcon\Mvc\Controller;

class UsersController extends Controller
{
    public function index()
    {
        
        $users = users::find();

        foreach ($users as $user) {
            $data[] = [
                "id"   => $user->id,
                "name" => $user->name,
            ];
        }

        echo json_encode($data);
        
        
    }

    public function show($slug)
    {
        // ...
    }
}