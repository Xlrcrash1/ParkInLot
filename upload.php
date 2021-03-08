<?php
require('SQLconnect.php');
session_start();

$img=$_FILES['img'];
if(isset($_POST['submit'])){ 
 if($img['name']==''){  
  echo "<h2>Please Upload An Image.</h2>";
 }else{
  $filename = $img['tmp_name'];
  $client_id="23de5a82f549b92";
  $handle = fopen($filename, "r");
  $data = fread($handle, filesize($filename));
  $pvars   = array('image' => base64_encode($data));
  $timeout = 30;
  $curl = curl_init();
  curl_setopt($curl, CURLOPT_URL, 'https://api.imgur.com/3/image.json');
  curl_setopt($curl, CURLOPT_TIMEOUT, $timeout);
  curl_setopt($curl, CURLOPT_HTTPHEADER, array('Authorization: Client-ID ' . $client_id));
  curl_setopt($curl, CURLOPT_POST, 1);
  curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($curl, CURLOPT_POSTFIELDS, $pvars);
  $out = curl_exec($curl);
  curl_close ($curl);
  $pms = json_decode($out,true);
  $url=$pms['data']['link'];
  if($url!=""){
   echo "<h2>Uploaded Without Any Problem</h2>";
   //echo "<img src='$url'/>";
   //echo "$url";

   $safe_url = mysqli_real_escape_string($database_connection_object, $url);
   $sql = "UPDATE Users SET carPhoto = '$url' WHERE userName = '{$_SESSION['userName']}'";
   $db->query($sql);
   //$_SESSION['photo'] = $row['carPhoto'];

   $_SESSION['photo'] = $url;
   $_SESSION['link'] = $url;
   header("location: profile.php");

  }else{
   echo "<h2>There's a Problem</h2>";
   echo $pms['data']['error'];  
  } 
 }
}
?>