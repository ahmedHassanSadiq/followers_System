<?php
session_start();

//session_unset();
//session_destroy();

if($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["signout"]) && $_GET["signout"]=="true") {
    session_unset();
    session_destroy();
}

const DB_HOST = "localhost";
const DB_USER = "root";
const DB_PASS = "password";
const DB_NAME = "folosys";

spl_autoload_register(function($class_name){
    require_once __DIR__."/../classes/$class_name.php"; 
});

$sign_in = new signin();

$log_in = new login();

$index = new indexProg();