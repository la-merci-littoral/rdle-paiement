<?php

require 'vendor/autoload.php';

// This is your test secret API key.
\Stripe\Stripe::setApiKey('pk_test_51MKmfEHCHeIMvgvqmuHVGLTmz16ZSgGZqVTqkZFVFULWIZfAUGQYth8V8ndOaB1YnFMfj3NUKFzsT34OCgRssfdU0009jFo3Ns');

function getOrderAmount() {
    return 1400;
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
    echo json_encode(['error' => $e->getMessage()]);
}

?>