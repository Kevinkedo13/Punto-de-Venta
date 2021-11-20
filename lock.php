<?php
  session_start();
  if ($_SESSION["logged"]) {
    
  }else {
    header("Location: /login.html");
  }
 ?>