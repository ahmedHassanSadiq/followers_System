<?php

require_once '../app/init.php';

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_SESSION["user"]["id"];
    $receiver_id = $_POST["id"];
    echo $index->followSomeone($id , $receiver_id);
}