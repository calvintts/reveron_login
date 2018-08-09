<?php
  session_start();
  if(isset($_POST['login'])){
    require 'db_connect.php';
    $email = mysqli_real_escape_string($conn,$_POST['login_email']);
    $password = mysqli_real_escape_string($conn,$_POST['login_password']);
    if(empty($email)||empty($password)){
      header('Location: ../index.php?login=empty');
      exit();
    }else{
      $sql = "SELECT * FROM users WHERE user_email='$email'";
      $result = mysqli_query($conn,$sql);
      $resultCheck = mysqli_num_rows($result);
      if($resultCheck<1){
        header('Location: ../index.php?login=error1');
        exit();
      }else{
        if($row = mysqli_fetch_assoc($result)){
          $hashedPwdCheck = password_verify($password,$row['user_password']);
          if($hashedPwdCheck == false)
          {
            header("Location: ../index.php?login=passworderror");
            exit();
          }elseif($hashedPwdCheck == true){
            $_SESSION['email'] = $row['user_email'];
            $_SESSION['firstname'] = $row['user_firstname'];
            $_SESSION['lastname'] = $row['user_lastname'];
            $_SESSION['org'] = $row['user_org'];
            header("Location: ../content/index.php");
            exit();
          }
        }
      }
    }
  }else{
  header('Location: ../index.php');
  exit();
  }
 ?>
