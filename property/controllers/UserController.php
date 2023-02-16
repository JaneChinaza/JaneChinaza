<?php

namespace app\controllers;

use app\Router;
use app\models\User;


class UserController 
{
    public function login(Router $router)
    {

        $errors = [];
        $userData = [
            'email' => '',
            'password' => ''

        ];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            
            $userData['email'] = $_POST['email'];
            $userData['password'] = $_POST['password'];
            
           $user = new User();
           $user->load($userData);
           $errors = $user->validate_login();

           if (empty($errors)) {
                 header('Location: /');
        }
    }
        // echo '<pre>';
        // var_dump($propertyData);
        // echo '</pre>'; 
        $router->renderView('users/login', [
            'user' => $userData,
            'errors' => $errors
        ]);
    }


    public function signup(Router $router)
    {

        $errors = [];
        $userData = [
            'user_name' => '',
            'email' => '',
            'userFile' => '',
            'phone_no' => '',
            'password' => '',
            'confirm_password' => '',

        ];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $userData['user_name'] = $_POST['name'];
            $userData['userFile'] = $_FILES['image'];
            $userData['email'] = $_POST['email'];
            $userData['phone_no'] = (int)$_POST['phone_no'];
            $userData['password'] = $_POST['password'];
            $userData['confirm_password'] = $_POST['confirm_password'];
            
           $user = new User();
           $user->load($userData);
           $errors = $user->validate_signup();
           if (empty($errors)) {
                 header('Location: /login');
                 exit;
        }
    }
        // echo '<pre>';
        // var_dump($propertyData);
        // echo '</pre>'; 
        $router->renderView('users/signup', [
            'errors' => $errors,
            'user' => $userData
        ]);
    }


    public function request(Router $router)
    {
        $errors = [];
        $requestData =[
            'reason'=> '',
            'years_of_experience'=>'',
            'agent_description'=>'',
        ];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $requestData['reason'] = $_POST['reason'];
            $requestData['years_of_experience'] = (int)$_POST['years_of_experience'];
            $requestData['agent_description'] = $_POST['description'];

            $user = new User();
                $user->load($requestData);
                $errors = $user->validate_request();
                if(empty($errors)){
                    header('Location: /');
                    exit;
                } 
        }
        $router->renderView('users/request_form',[
            'errors' => $errors,
            'request' => $requestData
        ]);
    }

    public function log_out()
    {
        unset($_SESSION['user_id']);
        unset($_SESSION['role_id']);
        unset($_SESSION['email']);
        unset($_SESSION['user_name']);
        unset($_SESSION['phone_no']);
        unset($_SESSION['password']);
        unset($_SESSION['user_image']);
        session_destroy();
        header('location: /login');
        
        
    }
}


