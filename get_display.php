<?php
include 'connect.php';

$sql = "SELECT lat, long FROM goose";
$result = pg_query($conn,$sql);
while($row = pg_fetch_assoc($result)) {

    <?php
    
}

?>
