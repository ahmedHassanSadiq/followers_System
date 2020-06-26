<?php

class session extends MysqliConnect{
    public function __construct($username) {
//        $this->query("`user_id`,`name`","users","WHERE username = '$username'");
//        $this->execute();
//        $arr = $this->fetch();
        $_SESSION["is_logged"] = true;
        $_SESSION["user"] = array(
            "user_name" => $username,
        );
    }
    
}
