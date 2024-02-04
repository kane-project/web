<?php

// Payments.php
// Handles payment processing
// Author: kiduswb

require 'vendor/autoload.php';
require_once("Utils.php");

use Stripe\Stripe;

/**
 * process_payment
 * Processes a payment
 * @param  string $card_number
 * @param  string $card_exp_month
 * @param  string $card_exp_year
 * @param  string $card_cvc
 * @param  int $amount
 * @param  string $currency
 * @return bool
 */
function process_payment($stripe_token, $amount, $currency = 'cad') 
{
    loadEnv();
    \Stripe\Stripe::setApiKey($_ENV['STRIPE_TEST_SKEY']);

    try 
    {
        // Create a PaymentIntent using the token
        $paymentIntent = \Stripe\PaymentIntent::create([
            'amount' => $amount,
            'currency' => $currency,
            'payment_method' => $stripe_token,
            'confirmation_method' => 'manual',
            'confirm' => true,
            'return_url' => 'https://yourwebsite.com/success', // Replace with your actual success page URL
        ]);

    }
    
    catch (\Stripe\Exception\CardException $e) 
    {
        error_log("Payment failed: " . $e->getMessage());
        return false;
    }

    catch (\Stripe\Exception\ApiErrorException $e) 
    {
        error_log("Payment failed: " . $e->getMessage());
        return false;
    }

    catch(Exception $e) 
    {
        error_log("Payment failed: " . $e->getMessage());
        return false;
    }

    return true;
}

