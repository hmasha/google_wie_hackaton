<?php

$sql = "SELECT lat, long FROM goose";
$result = pg_query($conn,$sql);
while($row = pg_fetch_assoc($result)) {
    $lat= $row["lat"];
    $long=$row["long"];
    ?>

    <script>
        var marker = new google.maps.Marker({
              position: pos2,
              map: map,
              title: 'Hello World!'
            });
    </script>

    <?php
    
}

?>
