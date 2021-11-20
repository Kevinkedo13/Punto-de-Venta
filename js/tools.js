function imprimir(toPrint, fecha, popup) {
    if (popup) {
      document.getElementById("popupFrame").classList.add('active');
    }
    
      

      var mywindow = window.open("", "print");

      // var mywindow = window.open('', 'PRINT', 'height=auto,width=auto');
      mywindow.document.open();
      mywindow.document.write('<html><head><title>' + 'Impresion de ticket'  + '</title>');

      mywindow.document.write('<link rel="stylesheet" href="/css/master.css">');

      mywindow.document.write('</head><body id="print">');

      mywindow.document.write('<div class="img"><img src="/img/bleka-black.png"></div>');

      mywindow.document.write('<div class="direccion center"><p><strong>Sucursal "Tianguis San Martin Texmelucan"</strong></p><p>Area de la cuchilla local 152.</p><p>Tels: 55-1575-3072 <br> 56-1603-1279</p></div>');

      mywindow.document.write('<div class="img"><p class="center">'+fecha+'</p></div>');

      var prepTable = '<table><tr class="bg-color"><td>PZ</td><td>Concepto</td><td>Precio</td><td>Monto</td></tr>';
      //var amountHtml = '<table><tr class="bg-color"><td>PZ</td><td>Concepto</td><td>Precio</td><td>Monto</td></tr>';
      totalForPrint = 0;
      toPrint.forEach(listToPrint);
      //amount.forEach(listAmount);
      
      function listToPrint(value, index, array) {
        prepTable += '<tr onclick="setCurrentItem('+value.originalIndex+','+value.id+')">';
        prepTable += '<td>' + value.pz + '</td>' + '<td>' + value.name + '</td>' + '<td>' + value.price + '</td>' + '<td>' + (value.pz * value.price) + '</td>';
        totalForPrint += value.pz * value.price;
        prepTable += '</tr>';
      }
      prepTable += '<tr class="total right"><td colspan="4">Total $' + totalForPrint +'</td></tr>';
      prepTable += '</table>';

      mywindow.document.write(prepTable);
      //document.getElementById("amountList").innerHTML = amountHtml;
      //console.log(total);


      //mywindow.document.write(document.getElementById('amountList').innerHTML);

      mywindow.document.write('<div><p class="center">Gracias por su compra, vuelva pronto</p><br><br></div>');

      mywindow.document.write('<button onclick="window.print()">Imprimir</button>');

      mywindow.document.write('</body></html>');
      mywindow.document.close();
      // mywindow.print();
      return true;

    }