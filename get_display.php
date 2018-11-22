<?php

$sql = "SELECT lat, long FROM goose";
$result = pg_query($conn,$sql);
while($row = pg_fetch_assoc($result)) {
$lat= $row["lat"];
$long=$row["long"];
echo $lat;
echo $long;
}


?>