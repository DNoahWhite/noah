<?php
session_start();
if (empty($_SESSION['active'])) {
header('location: ../'); //o ../index.php
}
?>


<header>
  <div class="header">

    <h1>EFIGEN</h1>
    <div class="optionsBar">
      <p>Bolivia, <?php echo fechaC(); ?></p>
      <span>|</span>
      <span class="user"><?php echo $_SESSION['user']; ?></span>
      <img class="photouser" src="img/user.png" alt="Usuario">
      <a href="salir.php"><img class="close" src="img/salir.png" alt="Salir del sistema" title="Salir"></a>
    </div>
  </div>
<?php include "nav.php"; ?>
</header>
