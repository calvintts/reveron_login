<?php
if(isset($_GET["logout"]))
{
  //logout
  session_start();
  session_unset();
  session_destroy();
  header("Location: ../index.php?logout=success");
  exit();
}
?>
