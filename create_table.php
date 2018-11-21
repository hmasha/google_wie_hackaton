<?php
include 'connect.php';
$sql = "CREATE TABLE public.goose
(
    user_id SERIAL PRIMARY KEY,
    position VARCHAR UNIQUE NOT NULL,
    category VARCHAR NOT NULL,
    g_location VARCHAR NULL,
    created_on TIMESTAMP NOT NULL,
   )";
$result=pg_query($conn,$sql);
if(!$result) { 
    $error= pg_last_error($conn);
    echo $error;
}
else{
    echo 'success';
}

?>