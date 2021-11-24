<!DOCTYPE html>
<html lang="es_MX" dir="ltr">
  <head>
    <meta charset="utf-8">
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  	<script src="https://kit.fontawesome.com/924c957932.js" crossorigin="anonymous"></script>
  	<link rel="stylesheet" href="/css/master.css">
  	<title>Cuenta</title>
  </head>
  <body>
    <div class="wrap">
      <?php include 'header.php'; ?>
      <div class="cuenta" id="cuenta" style="overflow:auto;height:100vh;">
        <div id="detalles">
          Haciendo la cuenta con el stock de fecha <span id="stockDate"></span>
          <br>
          con la venta de la semana del <span id="sellsDate"></span>
        </div>
        <div id="roberto">

        </div>
        <div id="aaron">

        </div>
        <div id="totales">

        </div>
        <div class="info">
          <div class="json">

          </div>
          <div class="total">

          </div>
          <textarea name="name" rows="8" cols="80" id="nuevoStockResto"></textarea>
        </div>
      </div>
    </div>
    <script type="text/javascript">
      <?php
        include 'ventas.php';
        include 'query.php';
        include 'stock.php';
       ?>

       // esta variable tendra el la suma de los articulos vendidos
       var itemsVendidos = {};
       ventas.forEach(plusSells);

       function plusSells(value, index, array) {
         value.forEach(splitItems);

         function splitItems(value, index, array) {
           // htmlItems += stock[String(value.id)];
           var idItemVendido = String(value.id);
           // var currentSuma = parseInt(itemsVendidos[idItemVendido]);
           if (itemsVendidos[idItemVendido]) {
             itemsVendidos[idItemVendido] = parseInt(itemsVendidos[idItemVendido]) + parseInt(value.pz);
           }else{
             itemsVendidos[idItemVendido] = parseInt(value.pz);
           }
         }
       }

       var inicioTabla = '<table class="contrast"><tr class="bg-color"><td>ID</td><td>Nombre</td><td>Precio</td><td>Quedaron</td><td>Hecharon</td><td>Para venta</td><td>Vendidas</td><td>Quedarian</td><td>Quedan</td><td>Perdida</td><td>Monto</td></tr>';
       var htmlItemsRoberto = '<h2>CUENTA DE ROBERTO</h2>';
       htmlItemsRoberto += inicioTabla;

       var htmlItemsAaron = '<h2>CUENTA DE AARON</h2>';
       htmlItemsAaron += inicioTabla;

       items.forEach(printItems);

  		 function printItems(value, index, array){


         if (value.seller == 'ROBERTO') {
           htmlItemsRoberto += '<tr class="'+value.id+'">';

           htmlItemsRoberto += '<td>'+value.id+'</td>';
           htmlItemsRoberto += '<td class="left">'+value.name+'</td>';
    			 htmlItemsRoberto += '<td class="precio">'+value.price+'</td>';
           if (stockResto[String(value.id)]) {
             var quedaron = stockResto[String(value.id)];
           }else{
             var quedaron = 0;
           }
           htmlItemsRoberto += '<td>'+quedaron+'</td>';
           htmlItemsRoberto += '<td>'+(stockCompra[String(value.id)] - quedaron)+'</td>';

           htmlItemsRoberto += '<td class="existencia">'+stockCompra[String(value.id)]+'</td>';

           if (itemsVendidos[String(value.id)]) {
             var vendidas = itemsVendidos[String(value.id)];
           }else {
             var vendidas = 0;
           }

           htmlItemsRoberto += '<td>'+vendidas+'</td>';

           htmlItemsRoberto += '<td class="quedarian">'+(stockCompra[String(value.id)] - vendidas)+'</td>';
           htmlItemsRoberto += '<td><input type="number" class="verificacion" onchange="verificar('+value.id+',\'roberto\')"></td>';
           htmlItemsRoberto += '<td class="perdida"></td>';
           htmlItemsRoberto += '<td class="monto"></td>';

    			 htmlItemsRoberto += '</tr>';

         }else if (value.seller == 'AARON') {
           htmlItemsAaron += '<tr class="'+value.id+'">';

           htmlItemsAaron += '<td>'+value.id+'</td>';
           htmlItemsAaron += '<td class="left">'+value.name+'</td>';
    			 htmlItemsAaron += '<td class="precio">'+value.price+'</td>';
           if (stockResto[String(value.id)]) {
             var quedaron = stockResto[String(value.id)];
           }else{
             var quedaron = 0;
           }
           htmlItemsAaron += '<td>'+quedaron+'</td>';
           htmlItemsAaron += '<td>'+(stockCompra[String(value.id)] - quedaron)+'</td>';

           htmlItemsAaron += '<td class="existencia">'+stockCompra[String(value.id)]+'</td>';

           if (itemsVendidos[String(value.id)]) {
             var vendidas = itemsVendidos[String(value.id)];
           }else {
             var vendidas = 0;
           }

           htmlItemsAaron += '<td>'+vendidas+'</td>';

           htmlItemsAaron += '<td class="quedarian">'+(stockCompra[String(value.id)] - vendidas)+'</td>';
           htmlItemsAaron += '<td><input type="number" class="verificacion" onchange="verificar('+value.id+',\'aaron\')"></td>';
           htmlItemsAaron += '<td class="perdida"></td>';
           htmlItemsAaron += '<td class="monto"></td>';

    			 htmlItemsAaron += '</tr>';
         }else{
           console.log('Verificar vendedor de los id'+value.id);
         }

      }
      htmlItemsRoberto += '<tr><td colspan="11" class="totalRoberto"></td></tr>';
      htmlItemsRoberto += '</table>';
      htmlItemsAaron += '<tr><td colspan="11" class="totalAaron"></td></tr>';
      htmlItemsAaron += '</table>';

       document.getElementById("stockDate").innerHTML = stockRestoFecha;
       document.getElementById("sellsDate").innerHTML = sellsFecha;
       document.getElementById("roberto").innerHTML = htmlItemsRoberto;
  		 document.getElementById("aaron").innerHTML = htmlItemsAaron;

       var montosRoberto = {};
       var montosAaron = {};
       var totalRoberto = 0;
       var totalAaron = 0;
       var Total = 0;

       var nuevoStockResto = {};

       function verificar(id, seller) {
         var currentQuedarian = parseInt($('tr.'+id+' td.quedarian').html());
         var currentVerificacion = parseInt($('tr.'+id+' input').val());
         var currentPerdida = currentQuedarian - currentVerificacion;
         var currentPrecio = parseInt($('tr.'+id+' td.precio').html());
         var currentExistencia = parseInt($('tr.'+id+' td.existencia').html());
         var currentVentaReal = currentExistencia - currentVerificacion;
         var monto = currentPrecio * currentVentaReal;

         $('tr.'+id+' td.perdida').html(currentPerdida);
         $('tr.'+id+' td.monto').html(monto);

         if (seller == 'roberto') {
           montosRoberto[String(id)] = monto;
         }else if (seller == 'aaron') {
           montosAaron[String(id)] = monto;
         }


         totalRoberto = 0;
         totalAaron = 0;
        Object.entries(montosRoberto).forEach(([key, value]) => {
          totalRoberto += value;
        });
        Object.entries(montosAaron).forEach(([key, value]) => {
          totalAaron += value;
        });
        $('.totalRoberto').html('Total $'+totalRoberto);
        $('.totalAaron').html('Total $'+totalAaron);

        nuevoStockResto[String(id)] = currentVerificacion;
        $('#nuevoStockResto').val(JSON.stringify(nuevoStockResto));
       }
    </script>
  </body>
</html>
