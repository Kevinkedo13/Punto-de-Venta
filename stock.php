<?php

$mysqli = new mysqli("choloncho.com", "cholonch_root", "1226barhumAN$", "cholonch_bleka");

if ($mysqli->connect_errno) {

  echo "Fallo al conectar a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;

}

$mysqli->set_charset("utf8");

$stocksResto = $mysqli->query("SELECT * FROM stock WHERE tipo='resto' ORDER BY id DESC LIMIT 1");
$stocksCompra = $mysqli->query("SELECT * FROM stock WHERE tipo='compra' ORDER BY id DESC LIMIT 1");

$mysqli->close;

$existenciaResto = '';
$existenciaCompra = '';

while($stockResto = $stocksResto->fetch_assoc()){
      $existenciaResto = $stockResto['existencia'];
      $stockRestoFecha = $stockResto['fecha'];
  }

while($stockCompra = $stocksCompra->fetch_assoc()){
      $existenciaCompra = $stockCompra['existencia'];
      $stockCompraFecha = $stockCompra['fecha'];
  }

$existencias = 'var stockResto = JSON.parse(\''.$existenciaResto.'\');var stockRestoFecha = \''.$stockRestoFecha.'\';var stockCompra = JSON.parse(\''.$existenciaCompra.'\');var stockRestoFecha = \''.$stockCompraFecha.'\';';

echo $existencias;
// $string = "{";
//   while($stock = $stock->fetch_assoc()){
//       $string .= $stock['id'] = $stock['id'];
//   }
// $string .= "}";
//
//
//
// $string = "[";
// while($item = $items->fetch_assoc()) {
//     $string .= '{"id":'.$item['id'].',"name":"'.$item['name'].'","cost":'.$item['cost'].',"price":'.$item['price'].',"seller":"'.$item['seller'].'","stock":'.$item['stock'].'},';
// }
// $string = substr($string, 0, -1);
//
// $string .= "]";
// $articulos = 'var items = JSON.parse(\''.$string.'\');';
// echo $articulos;

 ?>
