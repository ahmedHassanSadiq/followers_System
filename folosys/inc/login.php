<?php
if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $log_in->set_input($username,$password);
    $log_in->check_input();
}

?>
<form method="POST" action="<?php echo $_SERVER['PHP_SELF']?>" >
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
  <div class="form-row">r
      <br>
      <input  type="submit" class="btn btn-primary col-12"  id="inputCity" name="submit">
</form>

