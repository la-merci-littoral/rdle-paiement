<?php

    $servername = "ronde-de-l-espoir.fr";
    $username = "ctzs1179";
    $password = "Delta43theta!";
    $dbname = "ctzs1179_donations";
    $inseeAPIKey = "b0872199-23cd-3fcb-8cbe-96abb5a6c802";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

?>