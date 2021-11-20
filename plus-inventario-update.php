<?php

if ($_POST['existencia']) {

 $existencia = $_POST['existencia'];

$mysqli = new mysqli("localhost", "lector", "qhFM]HIvS[DAAJo0", "main_database");


if ($mysqli->connect_errno) {

  echo "Fallo al conectar a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;

}

$mysqli->set_charset("utf8");

$query = $mysqli->query("INSERT INTO stock (fecha, existencia) VALUES ('2021-10-18 01:00:00', '".$existencia."')");

$mysqli->close;

echo "actualizado";
}
 ?>
