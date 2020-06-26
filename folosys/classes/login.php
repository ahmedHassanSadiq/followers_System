<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of login
 *
 * @author ahmedPC
 */
class login extends MysqliConnect{
        private $username,$password;
    
    public function set_input($username , $password) {
        $this->username          = $this->esc($this->html($username));
        $this->password          = $this->esc($this->html($password));        
    }
    
    public function check_input() {
     if(!isset($this->username)) {
         echo "اسم المستخدم فارغا";
     }else if(!isset($this->password)){
         echo "كلمة المرور فارغة";
     }elseif (!$this->check_user($this->username , $this->password )) {
         echo "المستخدم غير مسجل";
     }else{
        new session($this->username);
        header("Location: index.php");
     }
     return false;
    }
    
    private function check_user($user,$pass) {
        $this->query("username", "users","WHERE username = '$user' and password = '$pass'");
        if($this->execute() && $this->rowCount() > 0 ) {
            return true;
        }
        return FALSE;
    }

    
}
