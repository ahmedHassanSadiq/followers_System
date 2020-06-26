<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of indexProg
 *
 * @author ahmedPC
 */
class indexProg extends MysqliConnect{
    public function setOtherSession($username){
        $this->query("user_id", "users","WHERE username = '$username'");
        if($this->execute() and $this->rowCount() > 0){
            $data = $this->fetch();
            $_SESSION["user"]["id"] = $data["user_id"];
        }
    }
    
    public function getNameById($id){
        $this->query("*", "users","WHERE user_id = '{$id}'");
        if($this->execute() && $this->rowCount() > 0){
            $arr = $this->fetch();
            return $arr["name"];
        }
    }
    
    public function addPost($id,$post_content){
        $date = time();
        $post_content = $this->esc($this->html($post_content));
        $this->insert("posts", "user_id,post_content,post_date", "'$id','$post_content','$date'");
        if($this->execute()) {
            return true;
        }else{
            return FALSE;
        }
    }
    
    public function getAllUsersWithCond($cond = NULL){
        $this->query("*", "users","$cond");
        if($this->execute() && $this->rowCount() > 0){
            while ($rows = $this->fetch()){
                $row[] = $rows;
            }
            return $row;
        }else{
            return NULL;
        }
    }
    
    // select sender id and receiver id if it exist in table
    // return true if its exist and false if not-exist
    public function check_follow_exts($sender_id , $receiver_id){
        $this->query("`sender_id`,`receiver_id`", "tbl_follow",
                "WHERE sender_id = $sender_id and receiver_id = $receiver_id ");
        if ($this->execute() && $this->rowCount() > 0 ){
            return TRUE;
        }else{
            return FALSE;
        }
    }
    
    public function delete_folo($sender_id,$receiver_id){
        $this->delete("tbl_follow", "sender_id", $sender_id, "AND receiver_id = $receiver_id");
        $this->execute();
    }
    
    public function minus_onefollo($receiver_id){
        $this->query("follower_number", "users","WHERE user_id = $receiver_id");
        $this->execute();
        $ne_num = $this->fetch()["follower_number"]-1;
        $this->update("users", "follower_number = $ne_num", "user_id", $receiver_id);
        $this->execute();
    }
    
    
    
    /*
     * this function check if the follow operation if exist or not
     * if it exist it would be deleted 
     * and if not exists it would be added
     */
    
    public function followSomeone($sender_id , $receiver_id){
        // unset follow
        if($this->check_follow_exts($sender_id, $receiver_id)){
            $this->delete_folo($sender_id, $receiver_id);
            $this->minus_onefollo($receiver_id);
        }
        // set follow
        else{
            $this->insert("tbl_follow", "`sender_id`,`receiver_id`", "'$sender_id','$receiver_id'"); 
            if ($this->execute()) {
                $this->query("follower_number", "users","WHERE user_id = $receiver_id");
                $this->execute();
                $new_num = $this->fetch()["follower_number"]+1;
                $this->update("users", "follower_number = $new_num", "user_id", $receiver_id);
                $this->execute();
                return TRUE;
            }  else {
                return FALSE;
            }
        }
    }
    
    public function getfollowedId($id){
        $this->query("receiver_id", "tbl_follow","WHERE sender_id = $id");
        if($this->execute() && $this->rowCount() > 0){
            while($ids = $this->fetch()){
                $id_[] = $ids;
            }
            foreach ($id_ as $new){
                $final[] = $new["receiver_id"];
            }
            return $final;
        }else{
            return null;
        }
    }

    public function showFollowerdPosts($id,$your_id){
        $ids = $this->getfollowedId($id);
        $this->query("*", "posts", "WHERE user_id = $your_id ORDER BY post_date DESC ");
        if($this->execute() && $this->rowCount() > 0){
            while($post = $this->fetch()){
                $posts[] = $post;
            }
        }
    if(isset($ids)) {
          foreach ($ids as $id){ // get posts for all members who had followed and save it in $posts array (indexed array);
          $this->query("*", "posts", "WHERE user_id = $id");
          if($this->execute() && $this->rowCount() > 0){
              while($post = $this->fetch()){
                  $posts[] = $post;
              }
          }
        }
    }
        if(isset($posts)){
            return $posts;
        }
    }
    
    public function getUserDetails($id){
        $this->query("*", "users","WHERE user_id = $id");
        if($this->execute() && $this->rowCount() > 0){
            return $this->fetch();
        }
    }
    
}
