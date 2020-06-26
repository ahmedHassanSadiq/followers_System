
<?php
if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $name = $_POST["name"];
    $profile_img = $_FILES["img"];
    $bio = $_POST["bio"];
    $sign_in->set_input($username , $password , $name , $profile_img , $bio);
    $sign_in->insert_();
}

?>
<form method="POST" action="<?php echo $_SERVER['PHP_SELF']?>" enctype='multipart/form-data'>
  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="inputEmail4">username</label>
      <input type="text" class="form-control" id="inputEmail4" name="username">
    </div>
    <div class="form-group col-md-6">
      <label for="inputPassword4">Password</label>
      <input type="password" class="form-control" id="inputPassword4" name="password" >
    </div>
  </div>
  <div class="form-group">
    <label for="inputAddress">name</label>
    <input type="text" class="form-control" id="inputAddress" placeholder="Ahmed Alsadi" name="name">
  </div>
  <div class="form-group">
    <label for="inputAddress2">profile photo</label>
    <input type="file" class="form-control" id="inputAddress2" name="img">
  </div>
  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="inputCity">bio</label>
      <input type="text" class="form-control" id="inputCity" name="bio">
    </div>
      <br>
      <input  type="submit" class="btn btn-primary col-12"  id="inputCity" name="submit">
</form>

