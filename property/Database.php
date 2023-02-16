<?php

namespace app;

use PDO;
use app\models\Property;
use app\models\User;
use app\models\Admin; 
use app\models\Agent;

class Database
{
    public static Database $db;
    public function __construct()
    {
        $this->pdo = new PDO('mysql:host=localhost;port=3306;dbname=property', 'root', '');
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        self::$db = $this;
    }

    public function getProperty($search = '')
    {
        
    if ($search) {
     $statement = $this->pdo->prepare('SELECT * FROM properties INNER JOIN image ON properties.unique_code = image.unique_code WHERE name LIKE :name GROUP BY properties.unique_code ORDER BY properties.create_date DESC');
     $statement->bindValue(':name', "%$search%");
    } else {
                /* select the column 'id' from tabel "properties" and join with column 'user_id' in table "user". 
        This piece of code establish the relationship withween the tables*/
     $statement = $this->pdo->prepare('SELECT * FROM properties LEFT JOIN image ON properties.unique_code = image.unique_code GROUP BY properties.unique_code ORDER BY properties.create_date DESC');
    }
    $statement->execute();
    return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function  getpropertyForSale()
    {
        $sale = "For sale";
        $sold = "Sold";
        $statement = $this->pdo->prepare('SELECT * FROM properties WHERE property_status LIKE :sale 
        OR property_status LIKE :sold ORDER BY create_date DESC');
        $statement->bindValue(':sale', "%$sale%");
        $statement->bindValue(':sold', "%$sold%");
        $statement -> execute();
        return $statement -> fetchAll(PDO::FETCH_ASSOC);

    }

    public function getPropertyByAgent($id = '' ){
        if(!$id){
            $statement= $this->pdo->prepare ("SELECT * FROM properties INNER JOIN user ON properties.id = user.user_id INNER JOIN image ON properties.unique_code = image.unique_code
            WHERE user_id = :user_id GROUP BY properties.unique_code ORDER BY properties.create_date DESC");
            $statement->bindValue(':user_id', $_SESSION['user_id']);
        }else{
        $statement= $this->pdo->prepare ("SELECT * FROM properties INNER JOIN user
         ON properties.id = user.user_id INNER JOIN image ON properties.unique_code = image.unique_code WHERE user_id = :user_id GROUP BY properties.unique_code ORDER BY properties.create_date DESC");
        $statement->bindValue(':user_id', $id);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
        }
    }

    public function  getAgentByProperty($id){
        $statement= $this->pdo->prepare ("SELECT * FROM properties INNER JOIN user ON properties.id = user.user_id WHERE id = :id ORDER BY user.user_id DESC");
        $statement->bindValue(':id', $id);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
}

    public function getPropertyById($id)
    {
        
        $statement= $this->pdo->prepare ('SELECT * FROM properties INNER JOIN user ON properties.user_id = user.id INNER JOIN agent_request ON user.id = agent_request.user_id WHERE id = :id');
        $statement->bindValue(':id', $id);
        $statement->execute();
        return $statement->fetch(PDO::FETCH_ASSOC);
    }

    public function getimageByUniqueCode($unique_code)
    {
        
        $statement= $this->pdo->prepare ('SELECT * FROM image WHERE unique_code = :unique_code');
        $statement->bindValue(':unique_code', $unique_code);
        $statement->execute();
        return $statement->fetch(PDO::FETCH_ASSOC);
    }

    public function deleteImage($id)
    {
        
        $statement= $this->pdo->prepare ('DELETE * FROM image WHERE id = :id');
        $statement->bindValue(':id', $id);
        $statement->execute();
        return $statement->fetch(PDO::FETCH_ASSOC);
    }

    public function deleteAllImage($unique_code)
    {
        
        $statement= $this->pdo->prepare ('DELETE * FROM image WHERE unique_code = :unique_code');
        $statement->bindValue(':unique_code', $unique_code);
        $statement->execute();
        return $statement->fetch(PDO::FETCH_ASSOC);
    }

    public function updateImage(Property $property)
    {
        
        foreach ($property->imagePath as $i => $image ){
            
            $code = $property->unique_code;
            $statement= $this->pdo->prepare ("INSERT INTO image(imagePath, unique_code)
                 VALUES(:imagePath, :unique_code)");
            $statement->bindValue(':imagePath', $image);
            $statement->bindValue(':unique_code', $code);
            $statement->execute();
        }/* die(); */
    }

    public function createProperty(Property $property)
    {
        $statement = $this->pdo->prepare("INSERT INTO properties (user_id, unique_code, name, description, bed, bath, type, price, property_status, create_date)
                                                        VALUES (:agent_id, :unique_code, :name, :description, :bed, :bath, :type, :price, :property_status, :date)");
        $statement->bindValue(':agent_id', $_SESSION['user_id']);
        $statement->bindValue(':name', $property->name);
        $statement->bindValue(':description', $property->description);
        $statement->bindValue(':bed', $property->bed);
        $statement->bindValue(':unique_code', $property->unique_code);
        $statement->bindValue(':bath', $property->bath);
        $statement->bindValue(':type', $property->type);
        $statement->bindValue(':price', $property->price);
        $statement->bindValue(':property_status', $property->property_status);
        $statement->bindValue(':date', date('y-m-d H:i:s'));
        $yes = $statement->execute();
        if($yes == 1){
            
            foreach ($property->imagePath as $i => $image ){
                var_dump($image);
                
                $code = $property->unique_code;
                $statement= $this->pdo->prepare ("INSERT INTO image(imagePath, unique_code)
                     VALUES(:imagePath, :unique_code)");
                $statement->bindValue(':imagePath', $image);
                $statement->bindValue(':unique_code', $code);
                $statement->execute();
            }/* die(); */
            
        }
    }

    public function updateProperty(Property $property)
    {
        $statement = $this->pdo->prepare("UPDATE properties SET name=:name, image = :image, description = :description,
             bed = :bed, bath = :bath, type = :type, price = :price, property_status = :property_status WHERE id = :id");
        $statement->bindValue(':name', $property->name);
        $statement->bindValue(':image', $property->imagePath);
        $statement->bindValue(':description', $property->description);
        $statement->bindValue(':bed', $property->bed);
        $statement->bindValue(':bath', $property->bath);
        $statement->bindValue(':type', $property->type);
        $statement->bindValue(':price', $property->price);
        $statement->bindValue(':property_status', $property->property_status);
        $statement->bindValue(':id', $property->id);
        $statement->execute();

    }
    public function deleteProperty($id)
    {
        $statement = $this->pdo->prepare('DELETE FROM properties WHERE id = :id');
        $statement->bindValue(':id', $id);
       return $statement->execute(); 
    }

    public function CreateUser(User $Users){
        $role_id =1;
        
        $statement = $this->pdo->prepare("INSERT INTO user ( user_name, email, phone_no, password, user_image, role_id)
                                                         VALUES(:user_name, :email, :phone_no, :password, :user_image, :role_id)"); 
        $statement->bindValue(':user_name', $Users->user_name);
        $statement->bindValue(':email', $Users->email);
        $statement->bindValue(':phone_no', $Users->phone_no);
        $statement->bindValue(':user_image', $Users->imagePath);
        $statement->bindValue(':password', $Users->password);
        $statement->bindValue(':role_id', $role_id);
        $statement->execute();
    }
 
    public function getUser($email, $password){
        $statement = $this->pdo->prepare('SELECT * FROM user WHERE email = :email');
        $statement->bindValue(':email', $email);
        $statement->execute();
        $row = $statement->fetch(PDO::FETCH_ASSOC);

        $hashpass = $row['password'] ?? null;
        if (password_verify($password, $hashpass)) {
            return false;
        } else {
            return $row;
        }
    }

     public function getEmail($email){
        $statement = $this->pdo->prepare('SELECT email FROM user WHERE email = :email');
        $statement->bindValue(':email', $email);
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        if($result){
            return $result;
        }else{
            return false;
        }

    }

    public function createRequest(User $Users){
        (int) $status=1;
         /* 1 means pending(request) */
         $statement = $this->pdo->prepare("INSERT INTO agent_request (reason, years_of_experience, user_id, status, agent_description)
                                                          VALUES(:reason, :years_of_experience, :user_id, :status, :agent_description)"); 
         $statement->bindValue(':reason', $Users->reason);
         $statement->bindValue(':years_of_experience', $Users->years_of_experience);
         $statement->bindValue(':user_id', $_SESSION['user_id']);
         $statement->bindValue(':status', $status);
         $statement->bindValue(':agent_description', $Users->agent_description);
         $statement->execute();
     }
 
     public function getPendingRequest()
     {
         (int)$status = 1;
         $join_str = "agent_request INNER JOIN user ON user.user_id=agent_request.user_id";
         $statement= $this->pdo->prepare ("SELECT * FROM agent_request INNER JOIN user ON 
            agent_request.id = user.user_id WHERE status = :status ORDER BY agent_request.id DESC");
         // $statement= $this->pdo->prepare ("SELECT * FROM $join_str ORDER BY agent_request.id DESC");
         $statement->bindValue(':status', $status);
         $statement->execute();
         return $statement->fetchAll(PDO::FETCH_ASSOC);
 
     }

     public function getAllRequest()
     {
         $join_str = "agent_request INNER JOIN user ON user.user_id=agent_request.id";
         $statement= $this->pdo->prepare ("SELECT * FROM agent_request INNER JOIN user 
            ON agent_request.id = user.user_id ORDER BY agent_request.id DESC");
         // $statement= $this->pdo->prepare ("SELECT * FROM $join_str ORDER BY agent_request.id DESC");
         $statement->execute();
         return $statement->fetchAll(PDO::FETCH_ASSOC);
 
     }
 
     public function checkAgentRequestExist($user_id)
     {
         $statement = $this->pdo->prepare('SELECT user_id FROM agent_request WHERE user_id = :user_id');
         $statement->bindValue(':user_id', $user_id);
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
             $statement = $this->pdo->prepare("UPDATE user SET role_id = :role_id WHERE id = :user_id"); 
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
             $statement = $this->pdo->prepare("UPDATE user SET role_id = :role_id WHERE id = :user_id"); 
             $statement->bindValue(':role_id', $role_id);
             $statement->bindValue(':user_id', $user_id);
             $statement->execute();
         }
     }
 
     public function getAgents()
     {
         $role_id =3;
         $statement= $this->pdo->prepare ("SELECT * FROM  user WHERE role_id = :role_id ORDER BY user_id DESC");
         $statement->bindValue(':role_id', $role_id);
         $statement->execute();
         return $statement->fetchAll(PDO::FETCH_ASSOC);
     }
    
}