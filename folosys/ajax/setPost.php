<?php
require_once '../app/init.php';

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_SESSION["user"]["id"];
    $post_content = $_POST["content"];
    echo $index->addPost($id,$post_content);
}