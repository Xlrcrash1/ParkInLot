<!--Written By: Terry Watson
//Description:
//This php file uses a plugin called geoplugin
//to find the users country, city, longitude, and latitude.
//The longitude and latitude will most likely be helpful in the future
//while developing the app.
-->
<html>
 <head>
  <title>Geolocation Test</title>
 </head>
 <body>
<?php  
$user_ip = getenv('REMOTE_ADDR');
$geo = unserialize(file_get_contents("http://www.geoplugin.net/php.gp?ip=$user_ip"));
$country = $geo["geoplugin_countryName"];
$city = $geo["geoplugin_city"];
$longitude = $geo["geoplugin_longitude"];
$latitude = $geo["geoplugin_latitude"];
echo "User country: " . $country;
echo "\r\nUser city: " . $city . "<br>";
echo "\r\nUser longitude: " . $longitude . "<br>";
echo "\r\nUser latitude: " . $latitude . "<br>";

?> 
 </body>
</html>
