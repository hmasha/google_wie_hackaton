<?php
include 'connect.php';
echo "test,i'm here";
$sql = "SELECT * FROM goose";
$result = pg_query($conn,$sql);
if(!$result) { 
    $error= pg_last_error($conn);
    echo $error;
    echo "why oh please display";
}
else{
while($row = pg_fetch_assoc($result)) {
$lat= $row["lat"];
$long=$row["long"];
echo $lat;
echo $long;
}
}

?>