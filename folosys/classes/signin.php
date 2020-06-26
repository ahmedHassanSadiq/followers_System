<?php

class signin extends MysqliConnect {
    private $username , $password , $name , $profile_img , $bio , $new_image;
    
    public function set_input($username , $password , $name , $profile_img , $bio) {
        $this->username          = $this->esc($this->html($username));
        $this->password          = $this->esc($this->html($password));
        $this->name              = $this->esc($this->html($name));
        $this->profile_img       = $profile_img;
        $this->bio       = $this->esc($this->html($bio));
        
    }
    
    private function check_input() {
        
         $image = new adentifyimage($this->profile_img);
         $images = $image->getuploadedphoto();
         
     if(!isset($this->username)) {
         
     }else if(!isset($this->password)){
         
     }else if(!isset($this->name)){
         
     }else if(!isset($this->bio)){
         
     }else if(!isset($images)){
         echo "هناك خطأ في الصورة";
     }else{
         $this->profile_img = $images;
         return TRUE;
         
     }
     return false;
    }
    

    
    public function insert_(){
        if($this->check_input()) {
            
            $this->insert("users", "username, password, name, profile_image, bio",
                           " '$this->username' , '$this->password' , '$this->name' , '$this->profile_img' , '$this->bio'");
            if($this->execute()) {
                new session($this->username, $this->name);
                header("Location: index.php");
            }
        }
    }
    
    
}
