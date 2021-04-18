<DOCTYPE! HTML>
<html>

    <head>

        <title>GPS 1</title>
    </head>

    <body>


    <p id="demo"></p>

    <script>
        var counter = 0;

        var x = document.getElementById("demo");

        var i = setInterval(function(){
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(showPosition);
            } else { 
                x.innerHTML = "Geolocation is not supported by this browser.";
            }

    counter++;
    /*if(counter === 10) {
        clearInterval(i);
    }*/
}, 2000);
        
            /*if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(showPosition);
            } else { 
                x.innerHTML = "Geolocation is not supported by this browser.";
            }*/
        

        function showPosition(position) {
            x.innerHTML = "Latitude: " + position.coords.latitude + 
            "<br>Longitude: " + position.coords.longitude + "<br>counter: " + counter;
        }

    </script>


    </body>
</html>