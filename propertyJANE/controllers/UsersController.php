<?php
namespace app\controllers;

use app\Router;

use app\models\Users;

class UsersController{
    public function login(Router $router){
        $errors = [];

        $userData = [
            'email' => '',
            'password' => ''
        ];

        if($_SERVER["REQUEST_METHOD"] === 'POST'){
            $userData['email'] = $_POST['email'];
            $userData['password'] = $_POST['password'];

            $User = new Users();
            $User->load($userData);
            $errors = $User->validate_login();

            if(empty($errors)){
                header('location: /');
            }
        }
        $router->renderView('users/login', [
            'user' => $userData,
            'errors' => $errors
        ]);
    }
   
    public function sign_up(Router $router){
        $errors = [];
        $userData = [
            'first_name' => '',
            'userFile' => '',
            'last_name' => '',
            'phone_no' => '',
            'password' => '',
            'confirm_password' => '',
            'email' => '',

        ];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $userData['first_name'] = $_POST['first_name'];
            $userData['userFile'] = $_FILES['user_image'];
            $userData['last_name'] = $_POST['last_name'];
            $userData['phone_no'] = (int)$_POST['phone_no'];
            $userData['password'] = $_POST['password'];
            $userData['confirm_password'] = $_POST['confirm_password'];
            $userData['email'] = $_POST['email'];

            $User = new Users();
                $User->load($userData);
                
                $errors = $User->validate_signup();
                if(empty($errors)){
                    header('Location: /login');
                    exit;
                } 
        }
        $router->renderView('users/sign_up',[
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
            'description'=>'',
        ];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $requestData['reason'] = $_POST['reason'];
            $requestData['years_of_experience'] = (int)$_POST['years_of_experience'];
            $requestData['description'] = $_POST['description'];

            $User = new Users();
                $User->load($requestData);
                $errors = $User->validate_request();
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
        unset($_SESSION['roleId']);
        unset($_SESSION['email']);
        unset($_SESSION['last_name']);
        unset($_SESSION['first_name']);
        unset($_SESSION['phone_no']);
        unset($_SESSION['password']);
        unset($_SESSION['user_image']);
        session_destroy();
        header('location: /login');
    }
}