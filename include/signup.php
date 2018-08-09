<?php
    if(isset($_POST['register'])){
      //connect to db
      require 'db_connect.php';
      //initialize variables
      $fname = mysqli_real_escape_string($conn,$_POST['fname']);
      $lname = mysqli_real_escape_string($conn,$_POST['lname']);
      $org = mysqli_real_escape_string($conn,$_POST['org']);
      $email = mysqli_real_escape_string($conn,$_POST['email']);
      $password = mysqli_real_escape_string($conn,$_POST['password']);
      $re_password = mysqli_real_escape_string($conn,$_POST['re_password']);
      $country = mysqli_real_escape_string($conn,$_POST['country']);
      if( (!preg_match("/^[a-zA-z]*$/",$fname)) || (!preg_match("/^[a-zA-z]*$/",$fname)))
      {
        //invalid names [only A to Z characters allowed]
        header("Location: ../index.php?signup=invalidname");
        exit();
      }
      else{
        if($password != $re_password)
        {
          //password does not match
          header("Location: ../index.php?passwordnotmatched");
          exit();
        }else{
                $sql = "SELECT * FROM users WHERE user_email='$email'";
                $result = mysqli_query($conn,$sql);
                $res_row = mysqli_num_rows($result);
                if($res_row>0)
                {
                  header("Location: ../index.php?emailexist");
                  exit();
                  //email already exist
                }else{
                  //hash password for security
                      $password = password_hash($password,PASSWORD_DEFAULT);
                      $sql = "INSERT INTO users ( user_firstname, user_lastname, user_email, user_org,  user_country, user_password ) VALUES ('$fname','$lname','$email','$org','$country','$password');";
                      //run the query
                      $result = mysqli_query($conn,$sql);
                      header('Location: ../index.php?signup=success');
                      exit();
                  }
                }
            }
    }else{
      //random access to signup.php denied
      header('Location: ../index.php');
      exit();
  }
?>
