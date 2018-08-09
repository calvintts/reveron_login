<?php
    if(isset($_POST['register'])){
      require 'db_connect.php';
      $fname = mysqli_real_escape_string($conn,$_POST['fname']);
      $lname = mysqli_real_escape_string($conn,$_POST['lname']);
      $org = mysqli_real_escape_string($conn,$_POST['org']);
      $email = mysqli_real_escape_string($conn,$_POST['email']);
      $password = mysqli_real_escape_string($conn,$_POST['password']);
      $re_password = mysqli_real_escape_string($conn,$_POST['re_password']);
      $country = mysqli_real_escape_string($conn,$_POST['country']);
      if($password != $re_password){
        echo "password does not match";
      }else {
      $password = password_hash($password,PASSWORD_BCRYPT);
      session_start();
      $_SESSION["email"] = $email;
      $_SESSION["firstname"] = $fname;
      $_SESSION["lastname"] = $lname;
      $sql = "INSERT INTO users ( user_firstname, user_lastname, user_email, user_org,  user_country, user_password ) VALUES ('$fname','$lname','$email','$org','$country','$password');";
      //run the query
      $result = mysqli_query($conn,$sql);
      header('Location: ../index.php?signup=success');
      exit();
    }
    }else{
      header('Location: ../index.php#nav-register');
      exit();
    }
?>
