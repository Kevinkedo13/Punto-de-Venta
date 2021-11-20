<?php
session_start();
  if (($_POST['user'] == 'lector') && ($_POST['pass'] == 'lector1234')) {
    $_SESSION["logged"] = true;
    header('Location: /index.php');
  }else{
    header('Location: /login.html?error=1');
  }

 ?>
