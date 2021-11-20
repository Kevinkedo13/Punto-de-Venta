<?php

// echo 'Se esta por agregar estilo';

$target_path = "img/articulos/";
$target_path = $target_path . basename( $_FILES['file']['name']);
$target_path = $target_path . ".jpg";

// $target_path = $target_path.$_POST['id'].".jpg";
if(move_uploaded_file($_FILES['file']['tmp_name'], $target_path)) {
    // echo "El archivo ".  basename( $_FILES['uploadedfile']['name']).
    // " ha sido subido con el nombre y ruta </br>".$target_path;
    // echo '<a href="https://kalamar.blekashop.com/items.php#'.$_POST['id'].'"><button>Regresar</button></a>';
    // echo $_POST;
    echo "listo";
} else{
    echo "Ha ocurrido un error, trate de nuevo!";
}

// foreach ($_POST as $key => $value) {
//   echo $key." = ".$value;
// }
// var_dump(json_decode($_POST, true));


// $upload = file_put_contents('img/hola.jpg', $_POST[0]);
//
// if ($upload {
//   echo "Listo";
// }else{
//   echo "error";
// }

// $data = json_decode($_POST);

var_dump($target_path);
 ?>
