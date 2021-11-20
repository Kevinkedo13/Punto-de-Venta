<!DOCTYPE html>
<html lang="es_MX">
<head>
	<meta charset="utf-8">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://kit.fontawesome.com/924c957932.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="/css/master.css">
    <title>AGREGAR COMPRA | BLEKASHOP | KALAMAR</title>
</head>
<body>
	<div class="wrap">
		<?php include 'header.php'; ?>
		<section id="agregarInventario">
			<button onclick="printLista('ROBERTO')">Lista de Roberto</button>
			<button onclick="printLista('AARON')">Lista de Aaron</button>
			<div class="list">
				
			</div>
			<div>
				<form action="plus-inventario-update.php" method="POST">
					<textarea class="detalle"></textarea>
					<input type="submit" name="" value="Actualizar">
				</form>
			</div>
		</section>
	</div>
	<script type="text/javascript">
		<?php
        include 'ventas.php';
        include 'query.php';
        include 'stock.php';
       ?>
       console.log(items);
       console.log(stockResto);

       // items.
		var inventarioActual = '<table><tr><td>ID</td><td>Nombre</td><td>Precio</td><td>Stock</td><td>Agregar</td><td class="nuevoStock">Nuevo Stock</td></tr>';
		var nuevoInventario = stockResto;
		items.forEach(splitItems);

		function splitItems(value, index, array) {
			inventarioActual += '<tr>';
			inventarioActual += '<td>'+value.id+'</td>';
			inventarioActual += '<td>'+value.name+'</td>';
			inventarioActual += '<td>'+value.price+'</td>';	
			if (stockResto[value.id]) {
				inventarioActual += '<td>'+stockResto[value.id]+'</td>';	
			}else{
				stockResto[value.id] = 0;
				inventarioActual += '<td>'+0+'</td>';	
			}
			
			
			inventarioActual += '<td><input type="number" class="'+value.id+'" onchange="actualizarInventario('+value.id+')"></td>';
			inventarioActual += '<td class="verActual '+value.id+'"></td>';
			inventarioActual += '</tr>';
		}

		inventarioActual += '</table>';

		$('#agregarInventario .list').html(inventarioActual);

		function actualizarInventario(id) {

			nuevoInventario[id] = stockResto[id] + parseInt($('input.'+id).val());
			console.log(nuevoInventario[id]);
			$('table td.'+id).html(nuevoInventario[id]);
			$('textarea.detalle').val(JSON.stringify(nuevoInventario));
		}

		$('input').change(function (argument) {
			console.log('se clickeo');
		})


		var tzoffset = (new Date()).getTimezoneOffset() * 60000; //offset in milliseconds

    		var localISOTime = (new Date(Date.now() - tzoffset)).toISOString().slice(0, 19).replace('T', ' ');
	    	
	    	function printLista(seller) {
		      //document.getElementById("popupFrame").classList.add('active');

		      var mywindow = window.open("", "print");

		      // var mywindow = window.open('', 'PRINT', 'height=auto,width=auto');
		      mywindow.document.open();
		      mywindow.document.write('<html><head><title>' + 'Impresion para existencias'  + '</title>');

		      mywindow.document.write('<link rel="stylesheet" href="/css/master.css">');

		      mywindow.document.write('</head><body id="printParaExistencia">');

		      // mywindow.document.write('<div class="img"><img src="/img/bleka-black.png"></div>');

		      //mywindow.document.write('<div class="direccion center"><p><strong>Sucursal "Tianguis San Martin Texmelucan"</strong></p><p>Area de la cuchilla local 152.</p><p>Tels: 55-1575-3072 <br> 56-1603-1279</p></div>');

		      mywindow.document.write('<p class="center">Imprimir para stock al cierre</p>');
		      mywindow.document.write('<p class="center"><strong>'+seller+'</strong></p>');
		      mywindow.document.write('<table><tr><td>Nombre</td><td>$</td><td>S.A.</td><td>N.S.</td></tr>');


		      	var inventarioActualPrint = '';
		      	items.forEach(splitInventario);
				function splitInventario(value, index, array) {
					if (value.seller == seller) {
						inventarioActualPrint += '<tr>';
						inventarioActualPrint += '<td>'+value.name+'</td>';
						inventarioActualPrint += '<td>'+value.price+'</td>';	
						inventarioActualPrint += '<td>'+nuevoInventario[value.id]+'</td>';						
						inventarioActualPrint += '<td>&nbsp;&nbsp;&nbsp;</td>';
						inventarioActualPrint += '</tr>';
					}
				}

				inventarioActualPrint += '</table>';
		      
				console.log(inventarioActualPrint);
		      mywindow.document.write(inventarioActualPrint);
		      mywindow.document.write('<div class="img"><p class="center">'+localISOTime+'</p></div>');

		      //mywindow.document.write(document.getElementById('amountList').innerHTML);		      
		      
		      mywindow.document.write('</table>');

		      mywindow.document.write('<button onclick="window.print()">Imprimir</button>');

		      mywindow.document.write('</body></html>');
		      mywindow.document.close();
		      // mywindow.print();
		      return true;

		    }
	</script>
</body>
</html>