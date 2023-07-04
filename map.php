<!DOCTYPE html >
  <head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
    <meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
    <title>Projeto Final Dev_Web2</title>
    <style>
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      #map {
        height: 98%;
      }
      /* Optional: Makes the sample page fill the window. */
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
    </style>
  </head>

  <body>
    <div id="map"></div>

    <script>
      var customLabel = {
        restaurant: {
          label: 'R'
        },
        bar: {
          label: 'B'
        }
      };

        function initMap() {
        var map = new google.maps.Map(document.getElementById('map'), {
          center: new google.maps.LatLng(-27.212369476612597, -49.640027758270215),
          zoom: 19
        });
        var infoWindow = new google.maps.InfoWindow;

          downloadUrl('conexao.php', function(data) {
          var markers = JSON.parse(data);
          markers.forEach(function(marker) {
            var name = marker.name;
            var address = marker.address;
            var type = marker.type;
            var lat = parseFloat(marker.lat);
            var lng = parseFloat(marker.lng);
            var point = new google.maps.LatLng(lat, lng);

            var infowincontent = document.createElement('div');
            var strong = document.createElement('strong');
            strong.textContent = name;
            infowincontent.appendChild(strong);
            infowincontent.appendChild(document.createElement('br'));

            var text = document.createElement('text');
            text.textContent = address;
            infowincontent.appendChild(text);

            var marker = new google.maps.Marker({
              map: map,
              position: point,
              icon: 'https://maps.google.com/mapfiles/ms/micons/gas.png'
            });

            // Evento para mostrar as informações da cordenada
            marker.addListener('click', function() {
              infoWindow.setContent(infowincontent);
              infoWindow.open(map, marker);
            });
        });
        });
        }

      function downloadUrl(url, callback) {
  var xhr = new XMLHttpRequest();
  xhr.onreadystatechange = function() {
    if (xhr.readyState === 4 && xhr.status === 200) {
      callback(xhr.responseText);
    }
  };
  xhr.open('GET', url, true);
  xhr.send();
}

      function doNothing() {}
    </script>
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY">
    </script>
    <a href="logout.php">
      <button>Sair</button>
    </a>
    <a href="cadastrar.php">
      <button>Cadastrar</button>
    </a>
  </body>
</html>