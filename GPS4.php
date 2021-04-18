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

      .custom-map-control-button {
        appearance: button;
        background-color: #fff;
        border: 0;
        border-radius: 2px;
        box-shadow: 0 1px 4px -1px rgba(0, 0, 0, 0.3);
        cursor: pointer;
        margin: 10px;
        padding: 0 0.5em;
        height: 40px;
        font: 400 18px Roboto, Arial, sans-serif;
        overflow: hidden;
      }
      .custom-map-control-button:hover {
        background: #ebebeb;
      }
    </style>
    <script>

      var lotA = {lat: 35.351902, lng: -119.103161};

      // Note: This example requires that you consent to location sharing when
      // prompted by your browser. If you see the error "The Geolocation service
      // failed.", it means you probably did not give permission for the browser to
      // locate you.
      let map, infoWindow;

      function initMap() {
        map = new google.maps.Map(document.getElementById("map"), {
          center: lotA,//{ lat: 35.34927995930253, lng: -119.10403631283585},
          zoom: 17,
          streetViewControl: false,
          zoomControl: false,
        });


        infoWindow = new google.maps.InfoWindow();
        
        var i = setInterval(function(){


        if (navigator.geolocation) {
            var checklocation = navigator.geolocation.getCurrentPosition(
              (position) => {
                const pos = {
                  lat: position.coords.latitude,
                  lng: position.coords.longitude,
                };
                infoWindow.setPosition(pos);
                infoWindow.setContent("Location found.");
                infoWindow.open(map);
                map.setCenter(pos);
              },
              () => {
                handleLocationError(true, infoWindow, map.getCenter());
              },{maximumAge:10000, timeout:5000, enableHighAccuracy: true}
            );

            marker = new google.maps.Marker({
                map,
                //animation: google.maps.Animation.DROP,
                position: lotA,
            });


//var myPlace = new google.maps.LatLng(45.4555729, 9.169236);
var myPlace = checklocation;

var marker = new google.maps.Marker({
    position: lotA, 
    map: map});

var marker = new google.maps.Marker({
    position: myPlace, 
    map: map});
       
var bounds = new google.maps.LatLngBounds(myPlace, Item_1);
map.fitBounds(bounds);


/*function toggleBounce() {

    if (marker.getAnimation() !== null) {
        marker.setAnimation(null);
    } else {
        marker.setAnimation(google.maps.Animation.BOUNCE);
    }
}*/

        } else {
            // Browser doesn't support Geolocation
            handleLocationError(false, infoWindow, map.getCenter());
          }
            //});

        }, 1000)
      }

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