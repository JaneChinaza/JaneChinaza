<?php
namespace app\models;

use app\Database;
use app\functions\RandomFunction;

class Users extends Database{
    public ?int $id = null;
    public ?string $first_name = null;
    public ?string $last_name = null;
    public ?string $email = null;
    public ?int $phone_no = null;
    public ?string $password = null;
    public ?string $confirm_password = null;
    public ?array $user_image = null;
    public ?string $imagePath;
    public ?string $reason;
    public ?int $years_of_experience;
    public ?string $description;

    public function load($data){
        $this->id = $data['id'] ?? null;
        $this->first_name = $data['first_name'] ?? null;
        $this->last_name = $data['last_name'] ?? null;
        $this->email = $data['email'] ?? null;
        $this->phone_no = $data['phone_no'] ?? null;
        $this->password = $data['password'] ?? null;
        $this->confirm_password = $data['confirm_password'] ?? null;
        $this->user_image = $data['userFile'] ?? null;
        $this->imagePath = $data['user_image'] ?? null;
        $this->reason = $data['reason'] ?? null;
        $this->years_of_experience = $data['years_of_experience'] ?? null;
        $this->description = $data['description'] ?? null;
    } 

    public function validate_signup(){
        $errors =[];
        if (!$this->first_name || !$this->last_name || !$this->email || !$this->phone_no){
            $errors[] = 'Basic information are required';
        }
        if(strlen($this->phone_no) < 11){
            $errors[] = 'Phone number must be atleast 11 digt';
        }
        if(!$this->password){
            $errors[] ='password is required';
        }elseif(!$this->confirm_password){
            $errors[] = 'you need to confirm password';
        }
        if ($this->password !== $this->confirm_password){
            $errors[] = 'Confirm with the right password';
        }
        if (!is_dir(__DIR__.'/../public/images')){
            mkdir(__DIR__.'/../public/images');
        }
        // $db = Database::$db;
        $user = $this->getEmail($this->email);
        if($user){
            if($this->email === $user['email_address']){
                $errors[] = 'Email Already Taken';
            }
        }
        if($this->user_image["name"] == null){
            $errors[] = "Please a personal image is required";
        }
        
        if(empty($errors)){
            
            if ($this->user_image && $this->user_image['tmp_name']){
                
                if($this->imagePath){
                    unlink(__DIR__.'/../public/'.$this->imagePath);
                }
                
                $this->imagePath = 'images/'.RandomFunction::randomString(8).'/'.$this->user_image['name'];
                mkdir(dirname(__DIR__.'/../public/'.$this->imagePath));
        
                move_uploaded_file($this->user_image['tmp_name'], __DIR__.'/../public/'.$this->imagePath);

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
            $errors[] = 'email field is required *';
        }
        if(!$this->password){
            $errors[] = 'password field is required *';
        }

        $db = Database::$db;
        if(empty($errors)){
            $user = $db->getUser($this->email, $this->password);
            if($user){
                $_SESSION['userId'] = $user['id'];
                $_SESSION['roleId'] = $user['role_id'];
                $_SESSION['email'] = $user['email_address'];
                $_SESSION['last_name'] = $user['last_name'];
                $_SESSION['first_name'] = $user['first_name'];
                $_SESSION['phone_no'] = $user['phone_no'];
                $_SESSION['sucess'] = 1;
                $_SESSION['user_image'] = $user['user_image'];
                // $errors[]= 1;
            }else{
                $errors[] = 'Wrong Email or Password';
            }
           
        }
                
        return $errors;
    }

    public function validate_request()
    {
        $errors = [];
        // $db = Database::$db;
        $request = $this->checkAgentRequestExist($_SESSION['userId']);
        if($request)
        {
            $errors[] = 'You have already submitted a request, which is now being processed.';
        }elseif(!$this->reason || !$this->years_of_experience || !$this->description)
        {
            $errors[] = 'All fields are complusory';
        }elseif(strlen($this->reason) < 10)
        {
            $errors[] = 'Your reason(s) must be at least 10 characters ';
        }elseif(strlen($this->description) > 150)
        {
            $errors[] = 'You must describe yourself in less than 100 words ';
        }

        if(empty($errors)){
            $this->createRequest($this);
        }
        return $errors;
    }
}
