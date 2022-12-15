<?php
namespace app;

use PDO;
use app\models\Property;
use app\models\Users;
use app\models\Admin; 
use app\models\Agent;
class Database
{
    public static Database $db;
    public function __construct()
    
    {
        $this->pdo = new PDO('mysql:host=localhost;port=3306;dbname=property_crud', 'root', '');
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
        self::$db = $this;
    
    } 

    public function  getproperty($search = '')
    {
        if($search){
            $statement = $this->pdo->prepare('SELECT * FROM property WHERE property_address LIKE :property OR property_name LIKE :property ORDER BY created_time DESC');
            $statement->bindValue(':property', "%$search%");
        } else{
             $statement = $this->pdo->prepare('SELECT * FROM property INNER JOIN users ON property.user_id = users.id ORDER BY created_time DESC');
        }
            $statement -> execute();
            return $statement -> fetchAll(PDO::FETCH_ASSOC);

    }

    public function  getpropertyForSale()
    {
        $sale = "For sale";
        $sold = "Sold";
        $statement = $this->pdo->prepare('SELECT * FROM property WHERE property_status LIKE :sale OR property_status LIKE :sold ORDER BY created_time DESC');
        $statement->bindValue(':sale', "%$sale%");
        $statement->bindValue(':sold', "%$sold%");
        $statement -> execute();
        return $statement -> fetchAll(PDO::FETCH_ASSOC);

    }

    public function getPropertyByAgent($id = '' ){
        if(!$id){
            $statement= $this->pdo->prepare ("SELECT * FROM property INNER JOIN users ON property.user_id = users.id WHERE user_id = :user_id ORDER BY users.id DESC");
            $statement->bindValue(':user_id', $_SESSION['userId']);
            $statement->execute();
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        }else{
        $statement= $this->pdo->prepare ("SELECT * FROM property INNER JOIN users ON property.user_id = users.id WHERE user_id = :user_id ORDER BY users.id DESC");
        $statement->bindValue(':user_id', $id);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
        }
    }

    public function  getAgentByProperty($property_id){
            $statement= $this->pdo->prepare ("SELECT * FROM property INNER JOIN users ON property.user_id = users.id WHERE property_id = :property_id ORDER BY users.id DESC");
            $statement->bindValue(':property_id', $property_id);
            $statement->execute();
            return $statement->fetchAll(PDO::FETCH_ASSOC);
    }
   
    
    public function getpropertyById($id)
    {
        $statement= $this->pdo->prepare ('SELECT * FROM property INNER JOIN users ON property.user_id = users.id  INNER JOIN agent_request 
        ON users.id = agent_request.user_id WHERE property_id = :id');
        $statement->bindValue(':id', $id);
        $statement->execute();
        return $statement->fetch(PDO::FETCH_ASSOC);

    }

    public function createproperty(property $property)
    {
        $statement = $this->pdo->prepare("INSERT INTO property ( user_id, unique_code, description, property_price, property_address, bed, bath, kitchen, property_status, property_type, created_time)
                                                         VALUES(:agent_id, :unique_code, :description, :property_price, :property_address, :bed, :bath, :kitchen,  :property_status, :property_type, :date)"); 
        $statement->bindValue(':agent_id', $_SESSION['userId']);
        $statement->bindValue(':unique_code', $property->unique_code);
        $statement->bindValue(':description', $property->description);
        $statement->bindValue(':property_price', $property->property_price);
        $statement->bindValue(':property_address', $property->property_address);
        $statement->bindValue(':bed', $property->bed);
        $statement->bindValue(':bath', $property->bath);
        $statement->bindValue(':kitchen', $property->kitchen);
        $statement->bindValue(':property_status', $property->property_status);
        $statement->bindValue(':property_type', $property->property_type);
        $statement->bindValue(':date', date('Y-m-d H:i:s'));
        $yes = $statement->execute();
        if($yes == 1){
            
            foreach($property->imagePath as $i => $image ){
                var_dump($image);
                
                $code = $property->unique_code;
                $statement= $this->pdo->prepare ("INSERT INTO property_image(imagePath, unique_code)
                                                                        VALUES(:imagePath, :unquie_code)");
                $statement->bindValue(':imagePath', $image);
                $statement->bindValue(':unique_code', $code);
                $statement->execute();
            }/* die(); */
            
        }
    }

    public function updateproperty(property $property)
    {
        $statement = $this->pdo->prepare("UPDATE property SET 
                                property_image=:property_image,
                                description=:description,
                                property_price=:property_price,
                                property_address=:property_address,
                                bed=:bed,
                                bath=:bath,
                                kitchen=:kitchen,
                                property_status=:property_status, 
                                property_type=:property_type WHERE property_id=:property_id"); 
        $statement->bindValue(':property_image', $property->imagePath);
        $statement->bindValue(':description', $property->description);
        $statement->bindValue(':property_price', $property->property_price);
        $statement->bindValue(':property_address', $property->property_address);
        $statement->bindValue(':bed', $property->bed);
        $statement->bindValue(':bath', $property->bath);
        $statement->bindValue(':kitchen', $property->kitchen);
        $statement->bindValue(':property_status', $property->property_status);
        $statement->bindValue(':property_type', $property->property_type);
        $statement->bindValue(':property_id', $property->property_id);
        $statement->execute();
    }

    public function deleteProperty($property_id)
    {
        $statement = $this->pdo->prepare('DELETE FROM property WhERE property_id =:property_id');
        $statement->bindValue(':property_id', $property_id);
        $statement->execute();
    }

    public function CreateUser(Users $Users){
        $role_id =1;
        
        $statement = $this->pdo->prepare("INSERT INTO users ( first_name, last_name, email_address, phone_no, password, user_image, role_id)
                                                         VALUES(:first_name, :last_name, :email, :phone_no, :password, :user_image, :role_id)"); 
        $statement->bindValue(':first_name', $Users->first_name);
        $statement->bindValue(':last_name', $Users->last_name);
        $statement->bindValue(':email', $Users->email);
        $statement->bindValue(':phone_no', $Users->phone_no);
        $statement->bindValue(':user_image', $Users->imagePath);
        $statement->bindValue(':password', $Users->password);
        $statement->bindValue(':role_id', $role_id);
        $statement->execute();
    }
    public function getUser($email, $password){
        $statement = $this->pdo->prepare('SELECT * FROM users WHERE email_address = :email');
        $statement->bindValue(':email', $email);
        $statement->execute();
        $row = $statement->fetch(PDO::FETCH_ASSOC);

        $hashpass = $row['password'] ?? null;
        if (password_verify($password, $hashpass)) {
            return $row;
        } else {
            return false;
        }
    }

    public function getEmail($email){
        $statement = $this->pdo->prepare('SELECT email_address FROM users WHERE email_address = :email');
        $statement->bindValue(':email', $email);
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        if($result){
            return $result;
        }else{
            return false;
        }

    }

    public function createRequest(Users $Users){
       (int) $status=1;
        /* 1 means pending(request) */
        $statement = $this->pdo->prepare("INSERT INTO agent_request (reason, years_of_experience, user_id, status, description)
                                                         VALUES(:reason, :years_of_experience, :user_id, :status, :description)"); 
        $statement->bindValue(':reason', $Users->reason);
        $statement->bindValue(':years_of_experience', $Users->years_of_experience);
        $statement->bindValue(':user_id', $_SESSION['userId']);
        $statement->bindValue(':status', $status);
        $statement->bindValue(':description', $Users->description);
        $statement->execute();
    }

    public function getPendingRequest()
    {
        (int)$status = 1;
        $join_str = "agent_request INNER JOIN users ON users.id=agent_request.user_id";
        $statement= $this->pdo->prepare ("SELECT * FROM agent_request INNER JOIN users ON agent_request.user_id = users.id WHERE status = :status ORDER BY agent_request.id DESC");
        // $statement= $this->pdo->prepare ("SELECT * FROM $join_str ORDER BY agent_request.id DESC");
        $statement->bindValue(':status', $status);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);

    }

    public function getAllRequest()
    {
        $join_str = "agent_request INNER JOIN users ON users.id=agent_request.user_id";
        $statement= $this->pdo->prepare ("SELECT * FROM agent_request INNER JOIN users ON agent_request.user_id = users.id ORDER BY agent_request.id DESC");
        // $statement= $this->pdo->prepare ("SELECT * FROM $join_str ORDER BY agent_request.id DESC");
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);

    }

    public function checkAgentRequestExist($userId)
    {
        $statement = $this->pdo->prepare('SELECT user_id FROM agent_request WHERE user_id = :userId');
        $statement->bindValue(':userId', $userId);
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        if($result){
            return $result;
        }else{
            return false;
        }
    }

    public function acceptRequest($user_id)
    {
        (int) $status = 2;

        $statement = $this->pdo->prepare("UPDATE agent_request SET status=:status WHERE user_id = :user_id"); 
        $statement->bindValue(':status', $status);
        $statement->bindValue(':user_id', $user_id);
        $yes = $statement->execute();
        if($yes == 1){
            $role_id = 3;
            $statement = $this->pdo->prepare("UPDATE users SET role_id = :role_id WHERE id = :user_id"); 
            $statement->bindValue(':role_id', $role_id);
            $statement->bindValue(':user_id', $user_id);
            $statement->execute();
        }
    }

    public function declineRequest($user_id)
    {
        (int) $status = 3;

        $statement = $this->pdo->prepare("UPDATE agent_request SET status=:status WHERE user_id=:user_id"); 
        $statement->bindValue(':status', $status);
        $statement->bindValue(':user_id', $user_id);
        $yes = $statement->execute();
        if($yes == 1){
            $role_id = 1;
            $statement = $this->pdo->prepare("UPDATE users SET role_id = :role_id WHERE id = :user_id"); 
            $statement->bindValue(':role_id', $role_id);
            $statement->bindValue(':user_id', $user_id);
            $statement->execute();
        }
    }

    public function getAgents()
    {
        $role_id =3;
        $statement= $this->pdo->prepare ("SELECT * FROM  users WHERE role_id = :role_id ORDER BY id DESC");
        $statement->bindValue(':role_id', $role_id);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }
}