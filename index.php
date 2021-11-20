<?php include 'lock.php' ?>
<!DOCTYPE html>
<html lang="es_MX" dir="ltr">
  <head>
    <meta charset="utf-8">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="/js/tools.js"></script>
    <script src="https://kit.fontawesome.com/924c957932.js" crossorigin="anonymous"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/master.css">
    <title>NUEVA VENTA | BLEKASHOP | KALAMAR</title>
  </head>
  <body>
    <div class="wrap">
      <?php include 'header.php' ?>

      <section id="sell">
        <div class="wrap patch2">
          <div class="filters">
            <i class="fas fa-filter button"></i>
            <div class="priceShortcuts">
              <p onclick="scrollList(10)">10</p>
              <p onclick="scrollList(20)">20</p>
              <p onclick="scrollList(30)">30</p>
              <p onclick="scrollList(40)">40</p>
              <p onclick="scrollList(50)">50</p>
              <p onclick="scrollList(60)">60</p>
              <p onclick="scrollList(70)">70</p>
              <p onclick="scrollList(80)">80</p>
              <p onclick="scrollList(90)">90</p>
              <p onclick="scrollList(100)">100</p>
              <p onclick="scrollList(110)">110</p>
              <p onclick="scrollList(120)">120</p>
              <p onclick="scrollList(130)">130</p>
              <p onclick="scrollList(140)">140</p>
              <p onclick="scrollList(150)">150</p>
              <p onclick="scrollList(160)">160</p>
              <p onclick="scrollList(170)">170</p>
              <p onclick="scrollList(180)">180</p>
              <p onclick="scrollList(190)">190</p>
              <p onclick="scrollList(200)">200</p>

            </div>
          </div>
          <div class="wrap patch">
            <div class="list" id="items"></div>
            <div class="amount" id="amount">
              <div id="amountList">

              </div>
              <div class="actions bg-color">
                <div class="wrap">
                  <div class="save">
                    <i class="far fa-save button"></i>
                  </div>
                  <div class="print">
                    <i class="fas fa-print button" onclick="imprimir(amount, localISOTime, true)"></i>
                  </div>
                  <div class="complete">
                    <i onclick="finish()" class="fas fa-check button"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
          
        </div>
        <div class="popup" id="popup"></div>
      </section>
      <div id="popupFrame">
        <iframe src="" width="" height="" name="print"></iframe>
        <div class="closeFrame" onclick="closeFrame()">
          <p class="bg-red">Cerrar</p>
        </div>
      </div>
    </div>

    <script type="text/javascript">
    <?php include 'query.php'; ?>
    // console.log(items);
    var htmlItems = '<div class="wrap">';
    var margen = 10;
    function printItems(value, index, array){
      if (value.price >= margen) {
        margenId = margen;
        margen += 10;
      }else{
        margenId = false;
      }
      htmlItems += '<div class="card" id="'+margenId+'"><div class="content bg-color" onclick="setCurrentItem(' + index + ',' + value.id + ')"><div class="wrap"><div class="img"><img src="/img/articulos/'+value.id+'.jpg" alt=""></div><div class="price bg-green">$' + value.price + '</div></div><div class="name bg-color">' + value.name + '</div></div></div>';
      // console.log(value.name);
    }
    items.forEach(printItems);
    htmlItems += '</div>';
    document.getElementById("items").innerHTML = htmlItems;
    // console.log(htmlItems);

    function deleteFromAmount(indexTarget) {
      delete amount[indexTarget];
      printAmount();
      closePopup();
    }

    var amount = [];

    function setCurrentItem(index, id) {
      exists = false;
      amountIndex = 0;
      amount.forEach(searchItem);

      function searchItem(value, index, array) {
        if (value.id == id) {
          exists = true;
          amountIndex = index;
        }
      }
      if (exists) {
        advertising = '<div class="bg-yellow normal"><p>Este articulo ya esta en la cuenta, agrege o reste cantidad.</p><button onclick="deleteFromAmount(amountIndex)">Quitar de la cuenta</button></div>';
        cantidad = amount[amountIndex].pz;
        price = amount[amountIndex].price;
        button = 'Actualizar';
      }else {
        advertising = '';
        cantidad = 1;
        button = 'Agregar';
        price = items[index].price;
      }
      var popup = document.getElementById("popup");
      var popupHtml = '<div class="content center">';
      popupHtml += advertising;
      popupHtml += '<div class="name"><p>' + items[index].name + '</p></div>';
      popupHtml += '<div class="price">$<input type="number" id="currentPrice" value="'+price+'"></div>';
      popupHtml += '<div class="cantidad"><i class="fas fa-minus-square red" onclick="modifyQuantity()"></i><input type="number" id="currentQuantity" value=' + cantidad +'><i class="fas fa-plus-square green" onclick="modifyQuantity(1)"></i></div>';
      popupHtml += '<div class="submit"><input class="bg-red" type="submit" value="Cerrar" onclick="closePopup()">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input class="bg-green" type="submit" value="' + button + '" onclick="addAmount(' + index +',' + id + ')"></div>'
      popupHtml += '</div>';
      popup.innerHTML = popupHtml;
      popup.classList.add('active');
    }

    function modifyQuantity(action) {

      currentQuantity = document.getElementById("currentQuantity").value;
      currentQuantity = parseInt(currentQuantity);

      if (action == 1) {
        currentQuantity++;
        document.getElementById("currentQuantity").value = currentQuantity;
        //console.log(currentQuantity);
      }else {
        if (!(currentQuantity == 1)) {
          currentQuantity--;
          document.getElementById("currentQuantity").value = currentQuantity;
        }else {

        }
      }
    }

    function closePopup() {
      document.getElementById("popup").classList.remove('active');
    }

    function addAmount(index, id){
      var exists = false;
      var currentIndex = 0;
      amount.forEach(searchItem);

      function searchItem(value, index, array) {
        if (value.id == id) {
          exists = true;
          currentIndex = index;
        }
      }

      if ((amount==0) || !exists) {
        var currentItem = {};
        currentItem.originalIndex = index;
        currentItem.id = items[index].id;
        currentItem.name = items[index].name;
        currentItem.price = document.getElementById("currentPrice").value;
        currentItem.pz = document.getElementById("currentQuantity").value;
        amount.push(currentItem);
      }else{
        amount[currentIndex].pz = document.getElementById("currentQuantity").value;
        amount[currentIndex].price = document.getElementById("currentPrice").value;
      }
      printAmount();
      closePopup();
    };

    var total = 0;
    function printAmount(){
      var amountHtml = '<table><tr class="bg-color"><td>PZ</td><td>Concepto</td><td>Precio</td><td>Monto</td></tr>';
      total = 0;
      amount.forEach(listAmount);
      function listAmount(value, index, array) {
        amountHtml += '<tr onclick="setCurrentItem('+value.originalIndex+','+value.id+')">';
        amountHtml += '<td>' + value.pz + '</td>' + '<td>' + value.name + '</td>' + '<td>' + value.price + '</td>' + '<td>' + (value.pz * value.price) + '</td>';
        total += value.pz * value.price;
        amountHtml += '</tr>';
      }
      amountHtml += '<tr class="total right"><td colspan="4">Total $' + total +'</td></tr>';
      amountHtml += '</table>';

      document.getElementById("amountList").innerHTML = amountHtml;
      console.log(total);
    }

    function scrollList(margen){
      if (margen) {
        var myElement = document.getElementById(margen);
        var topPos = myElement.offsetTop;
        document.getElementById('items').scrollTop = topPos;
      }

    }
    function closeFrame() {
      document.getElementById("popupFrame").classList.remove('active');
    }

    

    var tzoffset = (new Date()).getTimezoneOffset() * 60000; //offset in milliseconds

    var localISOTime = (new Date(Date.now() - tzoffset)).toISOString().slice(0, 19).replace('T', ' ');

    function finish(data) {

          var form = document.createElement('form');

          // document.body.appendChild(form);

          form.method = 'post';

          form.action = 'https://www.kalamar.blekashop.com/save_sell.php';

          document.body.appendChild(form);

          var date = document.createElement('input');

          var detalle = document.createElement('input');

          var totalo = document.createElement('input');

          date.type = "text";

          date.name = "fecha";

          date.value = localISOTime;

          detalle.type = "text";

          detalle.name = "detalle";

          detalle.value = JSON.stringify(amount);

          totalo.type = "text";

          totalo.name = "monto";

          totalo.value = total;

          form.appendChild(date);

          form.appendChild(detalle);

          form.appendChild(totalo);

          form.submit();

      }

    </script>
  </body>
</html>
