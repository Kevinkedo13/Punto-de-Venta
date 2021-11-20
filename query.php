<?php
//conectar a la base

$mysqli = new mysqli("localhost", "lector", "qhFM]HIvS[DAAJo0", "main_database");

if ($mysqli->connect_errno) {

  echo "Fallo al conectar a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;

}

$mysqli->set_charset("utf8");



//consultar los articulos

$items = $mysqli->query("SELECT * FROM items ORDER BY price ASC");

//desconectar

$mysqli->close();

// print_r($items);
// echo json_encode($items);
// echo "Returned rows are: " . $items -> num_rows;
// [{"id":121,"cantidad":3,"precio":"60.00","nombre":"CANGURO"},{"id":82,"cantidad":3,"precio":"65.00","nombre":"MOCHILA C. LENTEJUELA MINI"},{"id":12,"cantidad":"13","precio":"35.00","nombre":"CARTERA LARGA 1 CIERRE "},{"id":15,"cantidad":2,"precio":"40.00","nombre":"CARTERA LARGA DE 2 CIERRES"},{"id":13,"cantidad":3,"precio":"35.00","nombre":"CARTERA CORTA 2 CIERRES"},{"id":20,"cantidad":"1","precio":"50.00","nombre":"PORTACELULAR P. CINTURON"},{"id":14,"cantidad":2,"precio":"35.00","nombre":"CARTERA MINI"}]

$string = "[";
while($item = $items->fetch_assoc()) {
    $string .= '{"id":'.$item['id'].',"name":"'.$item['name'].'","cost":'.$item['cost'].',"price":'.$item['price'].',"seller":"'.$item['seller'].'","stock":'.$item['stock'].'},';
}
$string = substr($string, 0, -1);

$string .= "]";
$articulos = 'var items = JSON.parse(\''.$string.'\');';
echo $articulos;
 ?>
