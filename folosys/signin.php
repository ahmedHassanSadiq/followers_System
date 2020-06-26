 <?php 
 include_once 'app/init.php';
 require_once 'inc/head.php';
 require_once 'inc/signin.php';
 
    if(isset($_SESSION["is_logged"])) {
    header("Location: index.php");
}


 ?>

<?php require_once 'inc/footer.php'; 