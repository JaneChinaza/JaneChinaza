<?php

namespace app\models;

use app\Database;
use app\functions\RandomFunction;

class User extends Database
{
   public ?int $id = null;
   public ?string $user_name = null;
   public ?string $email = null;
   public ?string $phone_no = null;
   public ?string $password = null;
   public ?string $confirm_password = null;
   public ?string $imagePath;
   public ?array $user_image = null;
   public ?string $reason;
   public ?int $years_of_experience;
   public ?string $agent_description;

   public function load($data){
    $this->id = $data['id'] ?? null;
    $this->user_name = $data['user_name'] ?? null;
    $this->email = $data['email'] ?? null;
    $this->password = $data['password'] ?? null;
    $this->confirm_password = $data['confirm_password'] ?? null;
    $this->phone_no = $data['phone_no'] ?? null;
    $this->user_image = $data['userFile'] ?? null;
    $this->imagePath = $data['user_image'] ?? null;
    $this->reason = $data['reason'] ?? null;
    $this->years_of_experience = $data['years_of_experience'] ?? null;
    $this->agent_description = $data['agent_description'] ?? null;
   }

   public function validate_signup()
   {

    $errors = [];
    if (!$this->user_name || !$this->email || !$this->phone_no){
        $errors[] = 'Basic information are required';
    }
    if($this->phone_no !=""){
        $this->phone_no="0".$this->phone_no ;

    }

    if(strlen($this->phone_no) < 11){
        $errors[] = 'Phone number must be atleast 11 digt';
    }
    
    if(!$this->password){
        $errors[] ='password is required';
    }elseif(!$this->confirm_password){
        $errors[] = 'confirm password';
    }
    if ($this->password !== $this->confirm_password){
        $errors[] = 'Password does not match';
    }

    if (!is_dir(__DIR__ . '/../public/images')) {
        mkdir(__DIR__ . '/../public/images');
    }

    // $db = Database::$db;
    $user = $this->getEmail($this->email);
    if($user){
        if($this->email === $user['email']){
            $errors[] = 'Email Already Exist';
        }
    }

    if($this->user_image["name"] == null){
        $errors[] = "Please a personal image is required";
    } 

    if (empty($errors)) {
      
     if ($this->user_image && $this->user_image['tmp_name']){
    
        if ($this->imagePath) {
            unlink(__DIR__ . '/../public/' . $this->imagePath);
        }
    
        $this->imagePath = 'images/'.RandomFunction::randomString(8).'/'.$this->user_image['name'];
        mkdir(dirname(__DIR__.'/../public/'.$this->imagePath));
    
            move_uploaded_file($this->user_image['tmp_name'],__DIR__ . '/../public/' . $this->imagePath);
        }

        $this->password  = password_hash($this->password , PASSWORD_DEFAULT);
            
         $this->CreateUser($this);
   }
   return $errors;
}

public function validate_login()
    {
        $errors = [];
        if(!$this->email){
            $errors[] = 'email is required';
        }
        if(!$this->password){
            $errors[] = 'password is required';
        }
        
        $db = Database::$db;
        if(empty($errors)){
            $user = $db->getUser($this->email, $this->password);

            // die(var_dump($user));
            if($user){
                $_SESSION['user_id'] = $user['user_id'];
                $_SESSION['role_id'] = $user['role_id'];
                $_SESSION['email'] = $user['email'];
                $_SESSION['user_name'] = $user['user_name'];
                $_SESSION['phone_no'] = $user['phone_no'];
                $_SESSION['sucess'] = 1;
                
                $_SESSION['user_image'] = $user['user_image'];
                // $errors[]= 1;
            }else{
                $errors[] = 'Incorrect Email or Password';
            }
           
        } 

        return $errors;
    }

    public function validate_request()
    {
        $errors = [];
        // $db = Database::$db;
        $request = $this->checkAgentRequestExist($_SESSION['user_id']);
        if($request)
        {
            $errors[] = 'You have already submitted a request, which is now being processed.';
        }elseif(!$this->reason || !$this->years_of_experience || !$this->agent_description)
        {
            $errors[] = 'All fields are complusory';
        }elseif(strlen($this->reason) < 10)
        {
            $errors[] = 'Your reason(s) must be at least 10 characters ';
        }elseif(strlen($this->agent_description) > 150)
        {
            $errors[] = 'You must describe yourself in less than 100 words ';
        }

        if(empty($errors)){
            $this->createRequest($this);
        }
        return $errors;
    }
}