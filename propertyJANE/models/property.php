<?php
namespace app\models;

use app\Database;
use app\functions\RandomFunction;

class Property{
    public ?int $property_id = null;
    public ?string  $property_type = null;
    public ?string  $property_status = null;
    public ?string  $description = null;
    public ?float  $property_price = null;
    public ?string  $property_address = null;
    public ?array  $property_image = null;
    public ?int  $bed= null;
    public ?int  $bath = null;
    public ?array  $imagePath;
    public ?string $Path;
    public ?string  $unique_code;

    public function load($data){
        $this->property_id = $data['property_id'] ?? null;
        $this->property_type = $data['property_type'];
        $this->property_status = $data['property_status'];
        $this->property_price = $data['property_price'];
        $this->property_address = $data['property_address'];
        $this->description = $data['description'] ?? '';
        $this->bed = $data['bed'];
        $this->bath = $data['bath'];
        $this->kitchen = $data['kitchen'];

        $this->property_image = $data['propertyFile'] ?? null;
        $this->imagePath = $data['property_image'] ?? null;
    }
public function save(){
        $errors =[];
        if ( !$this->property_address|| !$this->property_price || !$this->property_image ||  !$this->bed|| !$this->bath || !$this->description || !$this->kitchen || $this->property_type == '0' || $this->property_status == '0' ){
            $errors[] = 'All fields are required';
        }
        if(count($this->property_image['name']) == 0){
            $errors[] = 'Atleast one image of the property is required';
        }
         //die(empty($this->property_image['name']));

/*  $errors =[];
        if(!$this->property_address|| !$this->property_price){
            $errors[] = 'address price';
        }if(!$this->property_image ){
            $errors[] = 'image';
        }
        if(!$this->bath || !$this->description){
            $errors[] = 'bath description';
        }
        if( !$this->kitchen ){
            $errors[] = 'kitchen';
        }
        if( $this->property_status == '0'){
            $errors[] = 'status';
        }
        if($this->property_type == '0'){
            $errors[] = 'type';
        }
        if(!$this->bed){
            $errors[] = 'bed';
        }
        if(!$this->property_price){
            $errors[] = 'price';
} */

       
        
        if (!is_dir(__DIR__.'/../public/images')){
            mkdir(__DIR__.'/../public/images');
        }
        if(empty($errors)){
            
            
            if ($this->property_image && $this->property_image['tmp_name']){
                    /* if($this->Path){
                        unlink(__DIR__.'/../public/'.$this->Path);
                    } */
                    $folder_name = RandomFunction::randomString(8);
                    
                   /*  $totalFiles = count($this->property_image['tmp_name']);
                    die($totalFiles) */;

                for($i = 0; $i < 3; $i++){
                    // this is to create a new name from the old image for the image
                    $file = explode('.',$this->property_image['name'][$i]);
                    $file_name = $file[0].RandomFunction::randomString(3);

                    // this gets the original extension of the image and adds it to the new name
                    $imageExtension = explode('.', $this->property_image['name'][$i]);
                    $imageExtension = strtolower(end($imageExtension));
                    
                    // this is the path name
                    $this->Path= 'images/'.$folder_name.'/'.$file_name.'.'. $imageExtension;

                        
                       if(!is_dir(__DIR__.'/../public/'.$this->Path)){
                        @mkdir(dirname(__DIR__.'/../public/'.$this->Path)); 
                       }
                    
                    move_uploaded_file($this->property_image['tmp_name'][$i], __DIR__.'/../public/'.$this->Path);
                    $this->imagePath[] = $this->Path;
                }
                // die(var_dump($this->imagePath));
                $db = Database::$db;
                if ($this->property_id){
                    $db->updateproperty($this);
                }else{
                    $this->unique_code = RandomFunction::randomString(10);
                    $db->createproperty($this);
                }

    }
    
    }
    return $errors;
}
}