<?php
include 'connect.php';
$time = time();
$lat = $_POST["lat"];
$long =$_POST["long"];
$size =$_POST["size"];
$sql = "INSERT INTO goose (id,lat,long,position,created_on,size) VALUES(DEFAULT, $1, $2, 0,$3,$4)";
$result = pg_query_params($conn, $sql, array($lat, $long,$time,$size));
/* CREATE TABLE goose (
    id SERIAL primary key,
    lat varchar NOT NULL,
    long varchar NOT NULL,
    position varchar default NULL,
    created_on varchar default NULL,
    size varchar default NULL
); */
if(!$result) { 
    $error= pg_last_error($conn);
    echo $error;
    echo 'why oh why';
}
else{
    header('Location: get_display2.php');
   // echo "here";
}

?>