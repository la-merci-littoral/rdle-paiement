<?php

    require 'vendor/autoload.php';

    // Secret API key
    \Stripe\Stripe::setApiKey('pk_test_51MKmfEHCHeIMvgvqmuHVGLTmz16ZSgGZqVTqkZFVFULWIZfAUGQYth8V8ndOaB1YnFMfj3NUKFzsT34OCgRssfdU0009jFo3Ns');

    $paymentIntent = \Stripe\PaymentIntent::create([
        'amount' => calculateOrderAmount($jsonObj->items),
        'currency' => 'eur',
        'automatic_payment_methods' => [
            'enabled' => true,
        ],
    ]);

    $output = [
        'clientSecret' => $paymentIntent->client_secret,
    ];

?>