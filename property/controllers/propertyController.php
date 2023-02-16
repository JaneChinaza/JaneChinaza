<?php

namespace app\controllers;

use app\models\Property;
use app\Router;
// use app\functions\RandomFunction;
use Mailer;

class propertyController
{
    public function create(Router $router)
    {
        if(loggedIn()){
            if($_SESSION['role_id'] == 3 || $_SESSION['role_id'] == 2){

        $errors = [];
        $propertyData = [
            'image' => '',
            'name' => '',
            'description' => '',
            'property_status' => '',
            'bed' => '',
            'bath' => '',
            'type' => '',
            'price' => '',
        ];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $propertyData['propertyFile'] = $_FILES['image'] ?? null;
            $propertyData['image'] = $_POST['image'] ?? null;
            $propertyData['name'] = $_POST['name'];
            $propertyData['description'] = $_POST['description'];
            $propertyData['property_status'] = $_POST['property_status'];
            $propertyData['bed'] = (int)$_POST['bed'];
            $propertyData['bath'] = (int)$_POST['bath'];
            $propertyData['type'] = $_POST['type'];
            $propertyData['price'] = (float)$_POST['price'];
            // $propertyData['unique_code'] = RandomFunction::randomString(10);
            
           $property = new Property();
           $property->load($propertyData);
           $errors = $property->save();
           if (empty($errors)) {
                 header('Location: /properties');
                 exit;
        }
    }
        // echo '<pre>';
        // var_dump($propertyData);
        // echo '</pre>'; 
        $router->renderView('properties/create', [
            'property' => $propertyData,
            'errors' => $errors
        ]);
    }

        }else{
            header('Location: /properties');
            exit;
        }

    }
        public function showActions(Router $router)
        {
            if(loggedIn()){
                if($_SESSION['role_id'] == 2){
                    $property =  $router->db->getProperty();
            
                    $router->renderView('properties/property_crud', [
                        'property' => $property
                    ]);
                }else{
                    header('Location: /' );
                }
            }else{
                header('Location: /' );
            }
            
        }

        public function showAgentActions(Router $router)
    {
        if(loggedIn()){
            if($_SESSION['role_id'] == 3 || $_SESSION['role_id'] == 2){
                $property =  $router->db->getPropertyByAgent();

                $router->renderView('properties/property_crud', [
                    'property' => $property
                ]);
            }else{
                header('Location: /' );
            }
        }else{
            header('Location: /' );
        }
        
    }


    public function update(Router $router)
    {
        if(loggedIn()){
            if($_SESSION['role_id'] == 3 || $_SESSION['role_id'] == 2){
            
            $id = $_GET['id'] ?? null;
        if(!$id){
            header('Location: /properties');
            exit;
        }
        $errors =[];
        $propertyData = $router->db->getPropertyById($id);

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $propertyData['propertyFile'] = $_FILES['image'] ?? null;
            $propertyData['imagePath'] = $propertyData->image ?? null;

            $propertyData['name'] = $_POST['name'];
            $propertyData['description'] = $_POST['description'];
            $propertyData['property_status'] = $_POST['property_status'];
            $propertyData['bed'] = (int)$_POST['bed'];
            $propertyData['bath'] = (int)$_POST['bath'];
            $propertyData['type'] = $_POST['type'];
            $propertyData['price'] = (float)$_POST['price'];
            
            

            $property = new Property();
           $property->load($propertyData);
           $errors = $property->save();
           if (empty($errors)) {
            header('Location: /properties');
                 exit;
        }
        }

        $router->renderView('properties/update', [
            'property' => $propertyData,
            'errors' => $errors
        ]);
    }
        }else{
            header('Location: /properties');
            exit;
        }
}

    public static function delete(Router $router)
    {
        $id = $_POST['id'] ?? null;
        if(!$id){
            header('Location: /properties');
            exit;
        }
        $router->db->deleteProperty($id);
        header('Location: /properties');
    }

    public function properties(Router $router)
    {
        $property =  $router->db->getProperty();
        $router->renderView('properties/properties', [
            'property' => $property
        ]);

    }

    public function property_single(Router $router)
    {
         $id = $_GET['id'] ?? null;
        if(!$id){
            header('Location: /properties');
            exit;
        }
        
        $property =  $router->db->getPropertyById($id);

        $router->renderView('properties/property_single', [
            'property' => $property
        ]);
    }

    public function propertiesForSale(Router $router)
    {
        $property =  $router->db->getPropertyForSale();
        $router->renderView('properties/properties_sales', [
            'property' => $property
        ]);
    }


    public function request_mail(Router $router)
    {
         
        $id = $_POST['request_id'];
           
            if(!$id){
                header('Location: /properties');
                exit;
            }

        
            $property =  $router->db->getpropertyById($id);
             /* echo "<pre>";
            var_dump($property);
            echo "</pre>"; */
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            if(loggedIn()){
                $adminEmail = 'janeeke123@gmail.com';
                $agentEmail = 'peteroffodile@gmail.com';
                $email = $_SESSION['email'];
                $message = ucwords($_SESSION['user_name' ]) . " ( email address: ". $email. " Phone no: ". $_SESSION['phone_no']. " ) ". " requested for property with property id ". $property['id'].  
                "<br>Name: ".$property['name'].
                "<br>Address: ".$property['description'].
                "<br>status: ".$property['property_status'].
                "<br>type: ".$property['type'].
                "<br><br>The agent in charge of this property is ".ucwords($property['user_name'])." with user id ".$property['id'];
                // die(var_dump($property_id));
                
                
                    $mail = new Mailer();
                    $mail->receiver = $adminEmail;
                    $mail->receiver2 = $agentEmail;
                    $mail->subject = "Property Request";
                    $template = $mail->mailTemplate();
                    $sitename = 'Jane.con';
        
                    $mail->body = $mail->inject($template, $sitename, "Property Request <br> ", " $message <br><br> Thanks <br> from $sitename...");
                    //  die($mail->body);		
                        if($mail->sendmessage()){
                            
                            header('Location: /properties/request_message');
                            exit;
                        }else{
                            die('not sent');
                            exit;
                                // die(' not sent'); 
                            }
            }else{
                header('Location: /login');
                exit;
            }
            
             
				
            
        } 
    }

    public function request_message(Router $router){
        $router->renderView('properties/request');
    }
}
