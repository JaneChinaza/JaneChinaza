<?php
namespace app\controllers;

use app\Router;
use app\models\Admin;
// require_once __DIR__."/../functions/Helper.php";

class AdminController
{
    public function dashboard(Router $router){
        if(loggedIn()){
            if($_SESSION['role_id'] == 2){
                $router->renderView('admin/dashboard');
            }else{
                header('Location: /' );
            }
        // } else{
        //     header('Location: /properties' );
        }
       
    }

    public function agent_request(Router $router){
        // $requestData =[];
        if(loggedIn()){
            if($_SESSION['role_id'] == 2){
                $requestData = $router->db->getPendingRequest();
                $router->renderView('admin/agent_request',[
                    'allAgentRequest'=> $requestData
                ]);
            }else{
                header('Location: /' );
            }
        }
        
    }

    public function request_list(Router $router){
        // $requestData =[];
        if(loggedIn()){
            if($_SESSION['role_id'] == 2){
                $requestData = $router->db->getAllRequest();
                $router->renderView('admin/request_list',[
                    'allAgentRequest'=> $requestData
                ]);
            }else{
                header('Location: /' );
            }
        }
    }

    public function request_accept(Router $router){
        $user_id = $_GET['id'] ?? null;
        if(!$user_id){
            header('Location: /agent_request');
            exit;
        }
        $router->db->acceptRequest($user_id);
        header('Location: /request_list');
    }

    public function request_decline(Router $router){
        $user_id = $_GET['id'] ?? null;
        if(!$user_id){
            header('Location: /agent_request');
            exit;
        }
        $router->db->declineRequest($user_id);
        header('Location: /request_list');
    }
}