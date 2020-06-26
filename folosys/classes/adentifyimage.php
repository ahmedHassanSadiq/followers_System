<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of adentifyimage
 *
 * @author ahmedPC
 */
class adentifyimage {
        private $image , $uploadImage;
        public function __construct($image) {
            $this->image = $image;
        }
        
        // add image to private image var
        
        
        // run  when class is construct (starts) 
        
        private function checkImage(){
            
        $images = $this->image;
        @$imageName  = $images['name'];
        @$imageTmp   = $images['tmp_name'];
        @$imageSize  = $images['size'];
        @$imageError = $images['error'];
        $imageExe = explode('.', $imageName);
        $imageExe = strtolower(end($imageExe));
        $newName = uniqid('post' , FALSE) . '.' . $imageExe;
        
        $allowed = ["jpg","jpeg" ,"bmp" , "gif","png"];
//        if(in_array($imageExe, $allowed) != 1) {
//            Messages::setMsg("خطأ", "يجب اختيار صورة حقيقية", "danger") ;
//            echo Messages::getMsg();
        if(0) {
            
        }else if($imageSize > 1024 * 1024) {
             echo "حجم الصورة جدا كبير";
        }else if($imageError != 0) {
             echo "يرجى ادخال صورة صحيحة";
        }
         else{
             $dir = __DIR__ . "/../libs/photos/" ;
             if(!file_exists($dir)){
                 mkdir($dir,TRUE);
             }
             $filedire = $dir.$newName;
             if(move_uploaded_file($imageTmp, $filedire)) {
                $this->uploadImage = $newName;
             }
             return TRUE;
           } // end else
           
           return false;
         } // end function
         
         public function getuploadedphoto(){
             if ($this->checkImage()) {
            return $this->uploadImage;
        } else{
            return null;
         }
    }
}

