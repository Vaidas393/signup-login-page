<?php
require 'includes.php';

$errors = ["email"=> "", "password" => ""];

if (isset($_POST["submit"]) && isset($_POST['token']) && $_SESSION['token'] == $_POST['token']) {
    $email=$_POST['email'];
    $password=$_POST['password'];

    if(empty($_POST["email"]) || ctype_space($_POST["email"])){
      $errors["email"] = "Fill in an email" . "<br/>";
    } else {
      $email = $_POST["email"];
      if (!preg_match('/^[\p{L}\p{Nd}+ .]+@[\p{L}\p{Nd}]+.[\p{L}\p{Nd}]+$/', $email)) {
        $errors["email"] = "Email, only 30 following characters allowed: Letters, numbers, dot " . "<br/>";
      }
    }

    if(empty($_POST["password"]) || ctype_space($_POST["password"])){
      $errors["password"] = "Fill in a password" . "<br/>";
    } else {
      $password = $_POST["password"];
      if (!preg_match('/^[\p{L}\p{Nd}+.!@#$%*]+$/', $password)) {
        $errors["password"] = "Email, only 30 following characters allowed: Letters, numbers, .!@#$%&* " . "<br/>";
      }
    }

    $email = addslashes($_POST['email']);
    $password = addslashes($_POST['password']);

    if($errors['password'] == "" && $errors['email'] == ""){
      $arr['email'] = $email;
      // $arr['password'] = $password;
      $query = "select * from users where email = :email limit 1";
      $stm = $con->prepare($query);
      $check = $stm->execute($arr);
      if($check){
        $data = $stm->fetchAll(PDO::FETCH_OBJ);
        if(is_array($data) && count($data) == 0){
          $errors["email"] = "Wrong email" . "<br/>";
        }
      }
    }

    if($errors['password'] == "" && $errors['email'] == ""){
      $arrp['password'] = $password;
      // $arr['password'] = $password;
      $query = "select * from users where password = :password limit 1";
      $stm = $con->prepare($query);
      $check = $stm->execute($arrp);
      if($check){
        $data = $stm->fetchAll(PDO::FETCH_OBJ);
        if(is_array($data) && count($data) == 0){
          $errors["password"] = "Wrong  password" . "<br/>";
        }
      }
    }

    if($errors['password'] == "" && $errors['email'] == ""){
    $arr['email'] = $email;
    $arr['password'] = $password;
    $query = "select * from users where email = :email && password = :password limit 1";
    $stm = $con->prepare($query);
    $check = $stm->execute($arr);

    if($check){
      $data = $stm->fetchAll(PDO::FETCH_OBJ);
      if(is_array($data) && count($data) > 0){
        $data = $data[0];
        $_SESSION['email'] = $data->email;
        header("Location: index.php");
        die;
      }
    }
  }
}

$_SESSION['token'] = getRandomString(25);

?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>LogIn</title>
    <link rel="stylesheet" href="css/style.css">
  </head>
  <body>
    <div class="nav">
      <nav>
        <ul>
          <li><a href="signup.php">Sign up</a></li>
          <li><a href="login.php">Log in</a></li>
        </ul>
      </nav>
    </div>
   <div class="center">
    <form class="" method="post">
      <input type="email" name="email" required placeholder="Email:" maxlength="30">
      <input type="password" name="password" required placeholder="Password:" minlength ="6" maxlength="30">
      <input type="hidden" name="token" value="<?=$_SESSION['token']?>">
      <input type="submit" name="submit" value="LogIn">
      <?php if($errors['password'] != "" OR $errors['email'] != ""){ ?>
      <p><?php  echo $errors["password"];?><span class="errors">!</span></p>
      <p><?php  echo $errors["email"];?><span class="errors">!</span></p>
      <?php } ?>
    </form>
   </div>
  </body>
</html>
