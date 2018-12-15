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
        width: 100%;
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
      <input type="image" src="goose.png" alt="Submit"/>    
    </form>
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
      //$pos = array(); //array to store positions of users
    
        while($row = pg_fetch_assoc($result)) 
        {
          $i = 0;
        ?>
        <script>   var pins = new Array();
       // pins[<?php echo $i; ?>] =  "<?php echo $row['lat']; ?>";
       // pins[<?php echo $i+1; ?>] =  "<?php echo $row['long']; ?>";

        pins[<?php echo $i; ?>] = "<?php echo $row['lat']; ?> , <?php echo $row['long']; ?>";
         
         </script>
        
<?php 
 $i++;
}} ?>
<script>
function initMap() {
  var map = new google.maps.Map(document.getElementById('map'), {
            center: {lat: -34.397, lng: 150.644},
            zoom: 19
   });

/* var locations = new Array();
            var latlngbounds = new google.maps.LatLngBounds();
            window.alert(pins.length);
            for (var i = 0; i < pins.length; i++) {
               
              var coordinates = pins[i].split(",");
              //alert(coordinates);
              locations[i] = new google.maps.LatLng(coordinates[0], coordinates[1]);
              latlngbounds.extend(locations[i]);
            } */
var infowindow = new google.maps.InfoWindow({});

var marker, i;
for ( i = 0; i < 5; i++)
{
  
        marker= new google.maps.Marker({
                    position:  new google.maps.LatLng(pins[i][0], pins[i][1]),
                    map: map,
                   // icon: image
                });
                infowindow.setContent('Geese Here');
				infowindow.open(map, marker);
}
}
</script>
  
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBHCjVEQ8w_JFtWn4VLWxkRN7h0e7NhDuk&callback=initMap"
    async defer>
</script>

</body>

</html>