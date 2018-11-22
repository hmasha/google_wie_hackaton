
<?php

//include 'insert_data.php';

?>

<!DOCTYPE html>
<html>
  <head>
    <title>Simple Map</title>
    <meta name="viewport" content="initial-scale=1.0">
    <meta charset="utf-8">
    <style>
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      #map {
        height: 80%;
        width: 80%;
      }
      /* Optional: Makes the sample page fill the window. */
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
    </style>
  </head>
  <body>
  
    <div id="map"></div>
    <form action="insert_data.php" method="post" id="form1">
      <input type="hidden" id="myLat" name="lat">
      <input type="hidden" id="myLong" name="long">
      <input type="submit" value="IM NEAR A GOOSE">
    </form>

    <script>
      //this code is from https://developers.google.com/maps/documentation/javascript/geolocation
      // Note: This example requires that you consent to location sharing when
      // prompted by your browser.                     If you see the error "The Geolocation service
      // failed.", it means you probably did not give permission for the browser to
      // locate you.
      var map, infoWindow;
      function initMap() {
        map = new google.maps.Map(document.getElementById('map'), {
          center: {lat: -34.397, lng: 150.644},
          zoom: 19
        });
        infoWindow = new google.maps.InfoWindow;

        // Try HTML5 geolocation.
        if (navigator.geolocation) {
          navigator.geolocation.getCurrentPosition(function(position) {
            var pos = {
              lat: position.coords.latitude,
              lng: position.coords.longitude
            };
            
            //setting the hidden form variables
            document.getElementById('myLat').value = position.coords.latitude;
            document.getElementById('myLong').value = position.coords.longitude;
            
            //test postition for a marker
            var pos2 = {
              lat: position.coords.latitude + 0.002,
              lng: position.coords.longitude + 0.002
            };

            infoWindow.setPosition(pos);
            infoWindow.setContent('You are here');
            infoWindow.open(map);
            map.setCenter(pos);
            
            //test code for a marker
            var marker = new google.maps.Marker({
              position: pos2,
              map: map,
              title: 'Hello World!'
            });
          }, function() {
            handleLocationError(true, infoWindow, map.getCenter());
          });
        } else {
          // Browser doesn't support Geolocation
          handleLocationError(false, infoWindow, map.getCenter());
        }
      }

      function handleLocationError(browserHasGeolocation, infoWindow, pos) {
        infoWindow.setPosition(pos);
        infoWindow.setContent(browserHasGeolocation ?
                              'Error: The Geolocation service failed.' :
                              'Error: Your browser doesn\'t support geolocation.');
        infoWindow.open(map);
      }
      
      </script>
     <?php
    include 'connect.php';
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    echo "test,i'm here";
    $sql = "SELECT * FROM goose";
    $result = pg_query($conn,$sql);
    if(!$result) 
    { 
        $error= pg_last_error($conn);
        echo $error;
        echo "why oh please display";
    }
    else
    {
        while($row = pg_fetch_assoc($result)) 
        {
        $lat= $row["lat"];
        $long=$row["long"];
        echo $lat;
        echo $long;

        echo '<script>';
            echo 'alert("<?php echo $lat; ?>");';
            echo 'map = document.getElementById('map');';
            echo 'var pos = { lat: "' . $lat . '", lng: "' . $long . '" };';
            echo 'var marker = new google.maps.Marker({position: pos, map: map, title: "Hello World!"});';
        echo '</script>';
        }
    }

    ?>
  

   

    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBHCjVEQ8w_JFtWn4VLWxkRN7h0e7NhDuk&callback=initMap"
    async defer></script>
  </body>
</html>
