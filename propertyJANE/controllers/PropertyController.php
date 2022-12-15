<?php
namespace app\controllers;

use app\Router;
use app\models\Property;
use Mailer;

class PropertyController
{
    public function create(Router $router)
    {
        if(loggedIn()){
            if($_SESSION['roleId'] == 3 || $_SESSION['roleId'] == 2){
                
            $errors =[];
        $propertyData =[
            'property_image' => '',
            'property_price' > '',
            'description' => '',
            'property_address' => '',
            'property_status' => '',
            'property_type' => '',
            'bed' => '',
            'bath' => '',
            'kitchen' => '',
        ];
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            
                /* echo'<pre>';
                var_dump($_FILES['property_image']);
                echo'</pre>';
            die(); */
                $propertyData['propertyFile'] = $_FILES['property_image'] ?? null;
                $propertyData['property_image'] = $_POST['property_image'] ?? null;
                $propertyData['property_address'] = $_POST['property_address'];
                $propertyData['property_status'] = $_POST['property_status'];
                $propertyData['property_type'] = $_POST['property_type'];
                $propertyData['description'] = $_POST['description'];
                $propertyData['property_price'] = (float)$_POST['property_price'];
                $propertyData['bed'] = (int)$_POST['bed'];
                $propertyData['bath'] = (int)$_POST['bath'];
                $propertyData['kitchen'] = (int)$_POST['kitchen'];
                

                $property = new Property();
                $property->load($propertyData);
                $errors = $property->save();
                if(empty($errors)){
                    header('Location: /properties');
                    exit;
                }
            }
                
        
        $router->renderView('property/create', [
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
            if($_SESSION['roleId'] == 2){
                $property =  $router->db->getProperty();
        
                $router->renderView('property/property_actions', [
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
            if($_SESSION['roleId'] == 3 || $_SESSION['roleId'] == 2){
                $property =  $router->db->getPropertyByAgent();

                $router->renderView('property/property_actions', [
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
            if($_SESSION['roleId'] == 3 || $_SESSION['roleId'] == 2){
            
            $id = $_GET['id'] ?? null;
        if(!$id){
            header('Location: /properties');
            exit;
        }
        $errors =[];
        $propertyData = $router->db->getPropertyById($id);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            
            $propertyData['propertyFile'] = $_FILES['property_image'] ?? null;
            $propertyData['imagePath'] = $propertyData->property_image ?? null;
           
            $propertyData['property_address'] = $_POST['property_address'];
            $propertyData['property_status'] = $_POST['property_status'];
            $propertyData['property_type'] = $_POST['property_type'];
            $propertyData['description'] = $_POST['description'];
            $propertyData['property_price'] = (float)$_POST['property_price'];
            $propertyData['bed'] = (int)$_POST['bed'];
            $propertyData['bath'] = (int)$_POST['bath'];
            

            $property = new Property();
            $property->load($propertyData);
            $errors = $property->save();
            if(empty($errors)){
                header('Location: /properties');
                exit;
            }
        }
       
        
            
    
        $router->renderView('property/update', [
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
        $property_id = $_POST['property_id'] ?? null;
        if(!$property_id){
            header('Location: /properties');
            exit;
        }
        $router->db->deleteProperty($property_id);
        header('Location: /properties');
    }
    
    public function properties(Router $router)
    {
        $property =  $router->db->getProperty();
        $router->renderView('property/properties', [
            'property' => $property
        ]);
    }
    
    public function single_property(Router $router){
        $id = $_GET['id'] ?? null;
        if(!$id){
            header('Location: /properties');
            exit;
        }

        $property =  $router->db->getPropertyById($id);

        $router->renderView('property/property-single', [
            'property' => $property
        ]);
    }
    
    public function propertiesForSale(Router $router)
    {
        $property =  $router->db->getPropertyForSale();
        $router->renderView('property/properties_sales', [
            'property' => $property
        ]);
    }

    public function request_mail(Router $router)
    {
         
        $property_id = $_POST['request_id'];
           
            if(!$property_id){
                header('Location: /properties');
                exit;
            }

            // $properties =  $router->db->getAgentByProperty($property_id);
            // echo "<pre>";
            // var_dump($properties);
            // echo "</pre>";
            $property =  $router->db->getpropertyById($property_id);
             /* echo "<pre>";
            var_dump($property);
            echo "</pre>"; */
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            if(loggedIn()){
                $adminEmail = 'oladepe1103@gmail.com';
                $agentEmail = 'peteroffodile@gmail.com';
                $email = $_SESSION['email'];
                $message = ucwords($_SESSION['last_name']." ".$_SESSION['first_name' ]) . " ( email address: ". $email. " Phone no: ". $_SESSION['phone_no']. " ) ". " requested for property with property id ". $property['id']. 
                "<br>Name: ".$property['property_name'].
                "<br>Address: ".$property['property_address'].
                "<br>status: ".$property['property_status'].
                "<br>type: ".$property['property_type'].
                "<br><br>The agent in charge of this property is ".ucwords($property['last_name']." ".$property['first_name'])." with user id ".$property['id'];
                // die(var_dump($property_id));
                
                
                    $mail = new Mailer();
                    $mail->receiver = $adminEmail;
                    $mail->reciever2 = $agentEmail;
                    $mail->subject = "Property Request";
                    $template = $mail->mailTemplate();
                    $sitename = 'Agnes.con';
        
                    $mail->body = $mail->inject($template, $sitename, "Property Request <br> ", " $message <br><br> Thanks <br> from $sitename...");
                    //  die($mail->body);		
                        if($mail->sendmessage()){
                            
                            header('Location: /property/request_message');
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
        $router->renderView('property/request');
    }
    
}