<DOCTYPE! HTML>
<html>

    <head>

        <title>GPS 1</title>
    </head>

    <body>


    <p id="demo"></p>

    <script>
        var x = document.getElementById("demo");

        //var timeout = setInterval(getLocation, 5000);

        //function getLocation (){

            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(showPosition);
            } else { 
                x.innerHTML = "Geolocation is not supported by this browser.";
            }

            //setInterval(getLocation, 5000);
        //}
        

        function showPosition(position) {
            x.innerHTML = "Latitude: " + position.coords.latitude + 
            "<br>Longitude: " + position.coords.longitude;
        }

    </script>


    </body>
</html>