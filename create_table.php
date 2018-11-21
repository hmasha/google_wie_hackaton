<?php
include 'connect.php';
$sql = 'CREATE TABLE goose(
    user_id serial PRIMARY KEY,
    position VARCHAR (50) UNIQUE NOT NULL,
    category VARCHAR (50) NOT NULL,
    location VARCHAR (355) ,
    created_on TIMESTAMP NOT NULL,
   );';
$result=pg_query($conn,$sql);
if(!$result) { 
    $error= pg_last_error($conn);
    echo $error;
}
else{
    echo 'success';
}

?>