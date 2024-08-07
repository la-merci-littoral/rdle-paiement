<?php

    require('../vendor/autoload.php'); // Loads the Stripe PHP library

    require('../../stripe-key.php'); // Includes the file that contains the Stripe API key

    // This is your test secret API key.
    \Stripe\Stripe::setApiKey($privKey); // Sets the Stripe API key

    function getOrderAmount() {
        session_start(); // Starts the session

        if(isset($_SESSION['amount_donated'])) { // Checks if the 'amount_donated' session variable is set
            return $_SESSION['amount_donated'] * 100; // Returns the value of 'amount_donated' multiplied by 100
        } else {
            header('Location: ../choix/montant/'); // Redirects the user to a different page if 'amount_donated' is not set
        }
    }

    header('Content-Type: application/json'); // Sets the response header to indicate that the response will be in JSON format

    try {

        // Create a PaymentIntent with amount and currency
        $paymentIntent = \Stripe\PaymentIntent::create([
            'amount' => getOrderAmount(), // Sets the amount for the PaymentIntent by calling the getOrderAmount() function
            'currency' => 'eur', // Sets the currency to EUR
            'automatic_payment_methods' => [
                'enabled' => true, // Enables automatic payment methods
            ],
        ]);

        $output = [
            'clientSecret' => $paymentIntent->client_secret, // Sets the 'clientSecret' property of the $output array to the client secret of the PaymentIntent
        ];

        echo json_encode($output); // Encodes the $output array as JSON and sends it as the response

    } catch (Error $e) {
        http_response_code(500); // Sets the HTTP response code to 500 (Internal Server Error)
        echo json_encode($e->getMessage()); // Encodes the error message as JSON and sends it as the response
    }

?>
