<?php require '../include/verify_login.php';?>
<html lang="en">
<?php include "header.php";?>
<body>
  <nav class="navbar sticky-top navbar-light bg-dark d-flex">
  <a class="navbar-brand mr-auto p-2 text-light">Welcome to CONTENT</a>
  <span class="navbar-text p-2 text-light">Logged in as: <?php echo $_SESSION['email'];?></span>
    <form class="form-inline p2" style="margin:5px;" action="../include/logout.php" method="GET">
      <button class="btn btn-primary my-2 my-sm-0" name="logout" type="submit">Logout</button>
    </form>
</nav>
<div>
<h1 class="h1">CESIUM CONTENT GOES HERE</h1>
</div>
</body>

</html>
