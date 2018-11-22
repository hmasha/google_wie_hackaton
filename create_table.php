<?php
include 'connect.php';
$drop ="DROP TABLE goose";
$resultdrop=pg_query($conn,$drop);
$sql = "CREATE TABLE goose
(
    id SERIAL PRIMARY KEY,
    lat VARCHAR NOT NULL,
    long VARCHAR NOT NULL,
    position VARCHAR,
    created_on TIMESTAMP NOT NULL
   )";
$result=pg_query($conn,$sql);
if(!$result) { 
    $error= pg_last_error($conn);
    echo $error;
    echo 'why oh why';
}
else{
    echo 'success';
}

?>