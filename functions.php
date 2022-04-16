<?php
function getRandomString($length) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randomString = '';

    for ($i = 0; $i < $length; $i++) {
        $index = rand(0, strlen($characters) - 1);
        $randomString .= $characters[$index];
    }

    return $randomString;
}


function loginCheck($con){
  if(isset($_SESSION['email'])){


    $arr['email'] = $_SESSION['email'];
    $query = "select * from users where email = :email limit 1";
    $stm = $con->prepare($query);
    $check = $stm->execute($arr);

    if($check){
      $data = $stm->fetchAll(PDO::FETCH_OBJ);
      if(is_array($data) && count($data) > 0){
        return $data[0];
      }
    }
  }
  header("Location: login.php");
  die;
}
 ?>
