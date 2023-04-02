<?php

    function verifySIREN($apiKey, $siren) {
        // turn SIREN into a usable string for the API
        $siren = str_replace(" ", "", $siren);
        $siren = str_replace(".", "", $siren);
        $siren = str_replace("_", "", $siren);
        $siren = str_replace("-", "", $siren);

        // Set the API endpoint URL
        $url = "https://api.insee.fr/entreprises/sirene/V3/siren/$siren";

        // Set up the HTTP headers
        $headers = array(
        'Accept: application/json',
        "Authorization: Bearer $apiKey",
        );

        // Initialize curl
        $curl = curl_init();

        // Set the curl options
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

        // Execute the curl request
        $response = curl_exec($curl);

        // Check for errors
        if (curl_errno($curl)) {
            $error = curl_error($curl);
            return "Error calling Insee Sirene API: $error";
        }

        // Close the curl connection
        curl_close($curl);

        // Parse the JSON response
        $data = json_decode($response, true);

        // return status of response
        return $data['header']['statut'];
    }

    function verifySIRET($apiKey, $siret) {
        // turn SIRET into a usable string for the API
        $siret = str_replace(" ", "", $siret);
        $siret = str_replace(".", "", $siret);
        $siret = str_replace("_", "", $siret);
        $siret = str_replace("-", "", $siret);

        // Set the API endpoint URL
        $url = "https://api.insee.fr/entreprises/sirene/V3/siret/$siret";

        // Set up the HTTP headers
        $headers = array(
        'Accept: application/json',
        "Authorization: Bearer $apiKey",
        );

        // Initialize curl
        $curl = curl_init();

        // Set the curl options
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

        // Execute the curl request
        $response = curl_exec($curl);

        // Check for errors
        if (curl_errno($curl)) {
            $error = curl_error($curl);
            return "Error calling Insee Sirene API: $error";
        }

        // Close the curl connection
        curl_close($curl);

        // Parse the JSON response
        $data = json_decode($response, true);

        // return status of response
        return $data['header']['statut'];
    }

?>