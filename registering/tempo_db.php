<?php

    $servername = "localhost";
    $username = "yannis";
    $password = "epsilon";
    $dbname = "lrde_test";

    $isSuccess = false;

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        echo "Oops, there was an error :(";
        die("Connection failed: " . $conn->connect_error);
    }

?>