<?php include 'lock.php' ?>
<!DOCTYPE html>

<html lang="es_MX" dir="ltr">

<head>

	<meta charset="utf-8">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <script src="https://kit.fontawesome.com/924c957932.js" crossorigin="anonymous"></script>
    <script src="/js/tools.js"></script>
    <link rel="stylesheet" href="/css/master.css">

    <title>VENTA | BLEKASHOP | KALAMAR</title>

</head>

<body>

	<div class="wrap">

		<?php include 'header.php' ?>

		<section id="venta">

			<div class="wrapper">

				<p class="center"><b>Lleva un total de $<span id="totalVenta"></span> en caja; de <span class="ventasN"></span> ventas.</b></p>

				<div class="list" id="ventaList">

				</div>

			</div>

		</section>

	</div>

	<script type="text/javascript">

		<?php include 'ventaSemanaEngine.php'; ?>

		console.log(ventas);

		var ventasHtml = '<table class="table-format">';

		var total = 0;
		var ventaN = 0;

		ventasHtml += '<tr><th>ID</th><th>N Venta</th><th>Detalles</th><th>Monto</th><th>Print</th></tr>';
		ventas.forEach(listVentas);



	      function listVentas(value, index, array) {
	      	ventaN++;
	      	ventasHtml += '<tr>';

	      	ventasHtml += '<td>'+value.id+'</td>';
	      	ventasHtml += '<td class="center">'+ventaN+'</td>';

	      	ventasHtml += '<td>"'+JSON.stringify(value.detalle)+'"</td>';
	      	//detalle = value.detalle;
	      	//ventasHtml += '<td>"'+detalle.name+'"</td>';

	      	ventasHtml += '<td>$'+value.total+'</td>';
	      	//detalleToObj = JSON.parse(value.detalle, true);
	      	ventasHtml += '<td><button onclick="printNow('+index+')">Imprimir</button></td>';

	      	total += value.total;

	      	ventasHtml += '</tr>';

	      }

	      ventasHtml += '</table>';

	      $('.ventasN').html(ventaN);
	      document.getElementById("totalVenta").innerHTML = total;

	      document.getElementById("ventaList").innerHTML = ventasHtml;

	      // console.log(total);
	      function printNow(index) {
	      	console.log(index);
			console.log(ventas[index].detalle);
			var cuenta = ventas[index].detalle;
			var fecha = ventas[index].fecha;
	      	imprimir(cuenta, fecha, false);
	      }




	</script>

</body>

</html>
