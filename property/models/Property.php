<?php

namespace app\models;

use app\Database;
use app\functions\RandomFunction;

class Property
{
   public ?int $id = null;
   public ?string $name = null;
   public ?string $description = null;
   public ?string $type = null;
   public ?string $property_status = null;
   public ?string $bed = null;
   public ?string $bath = null;
   public ?float $price = null;
   public ?array $imagePath;
   public ?string $Path;
   public ?array  $image = null;
   public ?string  $unique_code;

   public function load($data){
    $this->id = $data['id'] ?? null;
    $this->name = $data['name'];
    $this->description = $data['description'] ?? '';
    $this->bed = $data['bed'];
    $this->bath = $data['bath'];
    $this->type = $data['type'];
    $this->property_status = $data['property_status'];
    $this->price = $data['price'];
    $this->image = $data['propertyFile'] ?? null;
    $this->imagePath = $data['image'] ?? null;
   }

   public function save(){
    $errors = [];
    if (!$this->name ||!$this->price || !$this->image ||  !$this->bed|| !$this->bath || !$this->description || $this->type == '0' || $this->property_status == '0' ){
        $errors[] = 'All fields are required';
    }
    if(count($this->image['name']) == 0){
        $errors[] = 'Atleast one image of the property is required';
    }
    if (!is_dir(__DIR__ . '/../public/images')) {
        mkdir(__DIR__ . '/../public/images');
    }

    if (empty($errors)) {
      
     if ($this->image && $this->image['tmp_name']) {
    
       /* if ($this->imagePath) {
            unlink(__DIR__ . '/../public/' . $this->imagePath);
        }*/
        $folder_name = RandomFunction::randomString(8);
    
         /*  $totalFiles = count($this->property_image['tmp_name']);
                    die($totalFiles) */;

                    for($i = 0; $i < 3; $i++){
                        // this is to create a new name from the old image for the image
                        $file = explode('.',$this->image['name'][$i]);
                        $file_name = $file[0].RandomFunction::randomString(3);
    
                        // this gets the original extension of the image and adds it to the new name
                        $imageExtension = explode('.', $this->image['name'][$i]);
                        $imageExtension = strtolower(end($imageExtension));
                        
                        // this is the path name
                        $this->Path= 'images/'.$folder_name.'/'.$file_name.'.'. $imageExtension;
    
                            
                           if(!is_dir(__DIR__.'/../public/'.$this->Path)){
                            @mkdir(dirname(__DIR__.'/../public/'.$this->Path)); 
                           }
                        
                        move_uploaded_file($this->image['tmp_name'][$i], __DIR__.'/../public/'.$this->Path);
                        $this->imagePath[] = $this->Path;
                    }
                    // die(var_dump($this->imagePath));
                    $db = Database::$db;
                    if ($this->id){
                        $db->updateproperty($this);
                    }else{
                        $this->unique_code = RandomFunction::randomString(10);
                        $db->createProperty($this);
                    }
        }
    }

    return $errors;
   }
}