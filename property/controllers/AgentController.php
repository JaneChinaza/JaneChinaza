<?php
namespace app\controllers;

use app\Router;

class AgentController{

    public function agents(Router $router){
        $agents = $router->db->getAgents();
        
        $router->renderView('agents/agents',[
            'agents'=> $agents
        ]);
    }

    public function dashboard(Router $router){
        $router->renderView('agents/dashboard');
    }

    public function showAgentProperty(Router $router)
    {
        if(loggedIn()){
            if($_SESSION['role_id'] == 3 || $_SESSION['role_id'] == 2){
                $id = $_GET['agent'] ?? null;
                if(!$id){
                    header('Location: /properties');
                    exit;
                }else{
                    $property =  $router->db->getPropertyByAgent($id);
                }

                $router->renderView('properties/properties', [
                    'property' => $property
                ]);
            }else{
                header('Location: /' );
            }
        }
        
    }


}