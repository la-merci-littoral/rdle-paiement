<?php

    require('../vendor/autoload.php');
    require('../../stripe-key.php');

    // This is your test secret API key.
    \Stripe\Stripe::setApiKey($privKey);

    function getOrderAmount() {
        session_start();
        if(isset($_SESSION['amount_donated'])) {
            return $_SESSION['amount_donated'] * 100;
        } else {
            return 1400; // Temporary code to solve problem of no amount defined when Stripe looks for it.
        }
    }

    header('Content-Type: application/json');

    try {

        // Create a PaymentIntent with amount and currency
        $paymentIntent = \Stripe\PaymentIntent::create([
            'amount' => getOrderAmount(),
            'currency' => 'eur',
            'automatic_payment_methods' => [
                'enabled' => true,
            ],
        ]);

        $output = [
            'clientSecret' => $paymentIntent->client_secret,
        ];

        echo json_encode($output);

    } catch (Error $e) {
        http_response_code(500);
        echo json_encode($e->getMessage());
    }

?>
