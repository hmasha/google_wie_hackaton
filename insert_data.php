<?php
include 'connect.php';
$time = time();
$lat = $_POST["lat"];
$long =$_POST["long"];
$sql = "INSERT INTO goose (id,lat,long,position,created_on) VALUES(DEFAULT, $1, $2, 0,$3)";
$result = pg_query_params($conn, $sql, array($lat, $long,$time));

if(!$result) { 
    $error= pg_last_error($conn);
    echo $error;
    echo 'why oh why';
}
else{
    header('Location: get_display.php');
   // echo "here";
}

?>