<?php
include 'connect.php';
$sql = "CREATE TABLE goose
(
    id SERIAL PRIMARY KEY,
    position VARCHAR NOT NULL,
    category VARCHAR NOT NULL,
    created_on TIMESTAMP NOT NULL,
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