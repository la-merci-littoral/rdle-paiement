<?php

    $servername = "ronde-de-l-espoir.fr";
    $username = "ctzs1179";
    $password = "Delta43theta!";
    $dbname = "ctzs1179_donations";
    $inseeAPIKey = "ab3f4fab-4914-3b2d-9c89-7721b4a915ed";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

?>