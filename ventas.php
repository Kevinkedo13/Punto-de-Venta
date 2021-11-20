<?php

  //Vemos cuantos dias hay que restar para el lunes
  $daysToMonday = -1 + date(N);
  $daysToSunday = 7 - date(N);

  $hoy = date("Y-m-d H:i:s");
  $currentMonday = date("Y-m-d H:i:s", mktime(0, 0, 0, date("m")  , date("d")-$daysToMonday, date("Y")));
  $currentSunday = date("Y-m-d H:i:s", mktime(23, 59, 0, date("m")  , date("d")+$daysToSunday, date("Y")));

  $currentMondaySpanish = "Lunes " . date("d \D\E m \D\E\L Y", mktime(0, 0, 0, date("m")  , date("d")-$daysToMonday, date("Y")));
  // echo date('N');
  // echo $currentMondaySpanish;
  // echo $currentSunday;

  $mysqli = new mysqli("choloncho.com", "cholonch_root", "1226barhumAN$", "cholonch_bleka");

  if ($mysqli->connect_errno) {

    echo "Fallo al conectar a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;

  }

  $mysqli->set_charset("utf8");

  //consultar los articulos
  // SELECT * FROM cholonch_bleka.sells WHERE fecha BETWEEN '2021-10-11 00:00:00' AND '2021-10-17 23:59:00'

  $sells = $mysqli->query("SELECT * FROM sells WHERE fecha BETWEEN '".$currentMonday."' AND '".$currentSunday."'");

  //desconectar

  $mysqli->close;


  $arrayobj = new ArrayObject(array());

  $sellsString = '[';



  while ($sell = $sells->fetch_assoc()) {
    $sellsString .= $sell['detalle'];
    $sellsString .= ',';

  }

  $sellsString = substr($sellsString, 0, -1);

  $sellsString .= ']';

  $ventas = 'var ventas = JSON.parse(\''.$sellsString.'\');var sellsFecha = \''.$currentMondaySpanish.'\';';

  echo $ventas;

 ?>
