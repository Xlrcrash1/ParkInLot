<!DOCTYPE html>
<html>
  <head>
    <title>Geolocation</title>
    <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
    <style type="text/css">
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      #map {
        height: 100%;
      }

      /* Optional: Makes the sample page fill the window. */
      html,
      body {
        height: 100%;
        margin: 0;
        padding: 0;
      }

    </style>
    <script>

var lotA = {lat: 35.50950668816413, lng: -119.2692223161934};
//var myLocation = {lat: 35.51323466431219, lng: -119.2874653723435};
var bounds;

function showLocation(position) {

var latitude = position.coords.latitude;
var longitude = position.coords.longitude;
alert("Latitude : " + latitude + " Longitude: " + longitude);
}
      // Note: This example requires that you consent to location sharing when
      // prompted by your browser. If you see the error "The Geolocation service
      // failed.", it means you probably did not give permission for the browser to
      // locate you.
      let map, infoWindow;

      function initMap() {
        map = new google.maps.Map(document.getElementById("map"), {
          center: { lat: 35.34927995930253, lng: -119.10403631283585},
          zoom: 17,
          scrollwheel: false,
          disabledDoubleClickZoom: true,
          draggable: false,
          pancontrol: false,
          //streetViewControl: false
          disableDefaultUI: true
        });

        infoWindow = new google.maps.InfoWindow();
        
          // Try HTML5 geolocation.
          if (navigator.geolocation) {
            var myLocation = navigator.geolocation.watchPosition(
              (position) => {
                const pos = {
                  lat: position.coords.latitude,
                  lng: position.coords.longitude,
                };

var marker = new google.maps.Marker({
position: pos,
map: map,
icon: './Images/googleMapsIcons/car2.png'
});

marker = new google.maps.Marker({
  position: lotA,
  map: map,
  title: 'Parking Here'
});

bounds = new google.maps.LatLngBounds();
bounds.extend(lotA);
bounds.extend(pos);

map.fitBounds(bounds);
                //infoWindow.setPosition(pos);
                //infoWindow.setContent("Location found.");
                //infoWindow.open(map);
                //map.setCenter(pos);
              },
              () => {
                handleLocationError(true, infoWindow, map.getCenter());
              }, {maximumAge:10000, timeout:5000, enableHighAccuracy: true}
            );

/*marker = new google.maps.Marker({

  position: pos,
  map: map
});*/


/*marker = new google.maps.Marker({
  position: lotA,
  map: map
});

bounds = new google.maps.LatLngBounds();
bounds.extend(lotA);
bounds.extend(pos);

map.fitBounds(bounds);*/

          } else {
            // Browser doesn't support Geolocation
            handleLocationError(false, infoWindow, map.getCenter());
          }
      
      }//init map

      function handleLocationError(browserHasGeolocation, infoWindow, pos) {
        infoWindow.setPosition(pos);
        infoWindow.setContent(
          browserHasGeolocation
            ? "Error: The Geolocation service failed."
            : "Error: Your browser doesn't support geolocation."
        );
        infoWindow.open(map);
      }
    </script>
  </head>
  <body>
    <div id="map"></div>

    <!-- Async script executes immediately and must be after any DOM elements used in callback. -->
    <script
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDEufnZPhHwDTaDCuAPIKLNSTWVwprPmDk&callback=initMap&libraries=&v=weekly"
      async
    ></script>
  </body>
</html>