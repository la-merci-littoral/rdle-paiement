<?php

    require('vendor/autoload.php');

    // This is your test secret API key.
    \Stripe\Stripe::setApiKey('sk_test_51MKmfEHCHeIMvgvqTXYVUyZtuajFO0A5lBUjiULs41kScCE0yu9KVfMsBoCRYsCXiDWJKJvEAMNTj7LACNMrfyPG00ltgg5Vqo');

    function getOrderAmount() {
        session_start();
        return $_SESSION['amount'];
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