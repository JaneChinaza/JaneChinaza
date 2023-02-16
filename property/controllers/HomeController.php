<?php

namespace app\controllers;
use app\models\home;

use app\Router;
use Mailer;


class HomeController
{
    public function index(Router $router)
    {   
        $search = $_GET['search'] ?? '';
        $property =  $router->db->getProperty($search);
        $agents =  $router->db->getAgents();
        $router->renderView('home/index', [
            'property' => $property,
            'search'=>$search,
            'agent'=>$agents
        ]);      
    }

    public function contact(Router $router){
        $errors = [];
        $data = [
            'email' =>'',
            'user_name' => '',
            'subject' => '',
            'Message' => '',
        ];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data['email'] = $_POST['email'];
            $data['user_name'] = $_POST['user_name'];
            $data['subject'] = $_POST['subject'];
            $data['Message'] = $_POST['Message'];

        $adminEmail = 'janeeke123@gmail.com';
        $email = $data['email'];
        $message = $data['Message'];
        
        $contact = new home();
        $contact->load($data);
        $errors = $contact->save();
        
        if(empty($errors)){
            $mail = new Mailer();
            $mail->receiver = $adminEmail;
            $mail->subject = "Form Submission".$data['subject'];
            $template = $mail->mailTemplate();
            $sitename = 'Jane.con';
            $mail->body = $mail->inject($template, $sitename, "Form Submission <br> ", " $message from $email. <br> Thanks <br> from $sitename...");
                    
                if($mail->sendmessage()){
                    // die($yes);
                    header('Location: /');
                    exit;
                }else{
                    die('not sent');
                }
        }
    }

    $router->renderView('home/contact', [
        'errors' => $errors
    ]);
}
    public function about(Router $router){
        $router->renderView('home/about');
        
    }

    // public function services(Router $router){
    //  $router->renderView('home/services');
        
    // }
}