<?php
$servername = "choloncho.com";
$username = "cholonch_root";
$password = "1226barhumAN$";
$dbname = "cholonch_bleka";

$fecha = "'".$_POST['fecha']."'";
$detalle = "'".$_POST['detalle']."'";
$monto = "'".$_POST['monto']."'";
echo $fecha;
echo $detalle;
// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

$sql = "INSERT INTO sells (fecha, detalle, total)
VALUES ($fecha,$detalle,$monto)";

if (mysqli_query($conn, $sql)) {
  // echo "New record created successfully";
} else {
  echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

mysqli_close($conn);



 ?>
 <!DOCTYPE html>
 <html lang="es_MX" dir="ltr">
   <head>
     <link rel="stylesheet" href="/css/master.css">
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
     <meta charset="utf-8">
     <title>Venta registrada</title>
   </head>
   <body>
     <div class="wrapper">
       <h1>Venta guardada</h1>
       <div class="wrap-center">
         <div class="" id="lista">

         </div>
       </div>
       <div class="wrap-center">

         <button type="button" name="button" class="bg-color" onclick="imprimir()">Imprimir</button>
         &nbsp;&nbsp;&nbsp;<a href="/"><button type="button" name="button" class="bg-green">Nueva Venta</button></a>
       </div>
     </div>
     <script type="text/javascript">
        var items = <?php echo $_POST['detalle'];?>;
        var lista = "";
       function listar() {
         lista = '<tr><td>Pz</td><td>Producto</td><td>Precio</td><td>Monto</td></tr>';
         monto = 0;
         items.forEach(myFunction);
         function myFunction(value, index, array) {

           lista += '<tr onclick="setMod(' + index + ')">';
             lista += '<td>';
             lista += value.pz;
             lista += '</td>';
             lista += '<td>';
             lista += value.name;
             lista += '</td>';
             lista += '<td>';
             lista += value.price;
             lista += '</td>';
             lista += '<td>';
             lista += value.pz * value.price;
             lista += '</td>';
           lista += '</tr>';

           monto += value.pz * value.price;

         }
         lista += '<tr><td colspan="4" class="right"><strong>Total: $'+monto+'MXN</strong></td></tr>';
         $('#lista table').html(lista);
         // $('#monto').html(monto);
         cerrar();
       }
       listar();
       function imprimir() {

         var mywindow = window.open('', 'PRINT', 'height=auto,width=auto');

         mywindow.document.write('<html><head><title>' + 'Impresion de ticket'  + '</title>');
         mywindow.document.write('<link rel="stylesheet" href="/css/master.css">');
         mywindow.document.write('</head><body id="print">');
         mywindow.document.write('<div class="img"><img src="/img/bleka-black.png"></div>');
         // mywindow.document.write('<h1>' + document.title  + '</h1>');
         mywindow.document.write('<div class="direccion center"><p><strong>Sucursal "Tianguis San Martin Texmelucan"</strong></p><p><br>Area de la cuchilla local 152.</p><p>Tels: 56-1603-1279 <br> 55-1575-3072</p></div>');
         mywindow.document.write('<table>');

         mywindow.document.write(lista);
         mywindow.document.write('</table>');

         mywindow.document.write('<div class="right"><p><strong>Total: $'+monto+'MXN</strong></p></div>');
         mywindow.document.write('<button onclick="window.print()">Imprimir</button>');
         mywindow.document.write('</body></html>');

         // mywindow.document.close(); // necessary for IE >= 10
         // mywindow.focus(); // necessary for IE >= 10*/

         // mywindow.print();
         // mywindow.close();

         return true;
       }
     </script>
   </body>
 </html>
