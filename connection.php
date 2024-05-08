<?php

    $database= new mysqli("localhost","root","","edoc");
    if ($database->connect_error){
        die("Connection failed:  ".$database->connect_error);
    }

?>
<!-- this is the database connection -->