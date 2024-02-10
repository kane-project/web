<?php

// Utils.php
// Just a bunch of utilities for the site
// Author: kiduswb

require_once("vendor/autoload.php");

use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\Exception\UnsatisfiedDependencyException;

/**
 * slugify
 * Returns a slugified version of the string for use in URLs
 * @param  string $string - the string to slugify
 * @return string
 */
function slugify($string) {
    
    if (empty($string)) {
        $string = "ID";
    } else {
        $string = strtolower($string);
        $string = preg_replace("/[^a-z0-9_\s-]/", "", $string);
        $string = preg_replace("/[\s-]+/", " ", $string);
        $string = preg_replace("/[\s_]/", "-", $string);
    }

    if (empty($string)) {
        $string = "ID";
    }

    return $string. "-" . rand(1000, 9999);
}

/**
 * generate_uuid
 * Generates a UUID
 * @return string
 */
function generate_uuid() {
    try 
    {
        $uuid4 = Uuid::uuid4();
        return $uuid4->toString();
    } 
    
    catch (Exception $e) 
    {
        return "ID Generation Failed :(";
    }
}

/**
 * loadEnv
 * Loads the environment variables from an .env file
 * @param  string $envfile
 * @return void
 */
function loadEnv($envfile = ".env") {
    $env = file_get_contents($envfile);
    
    $env = explode("\n", $env);
    $env = array_filter($env);
    $env = array_map(function($line) {
        $line = explode("=", $line);
        $line[1] = trim($line[1]);
        return $line;
    }, $env);

    $env = array_combine(array_column($env, 0), array_column($env, 1));
    
    foreach ($env as $key => $value) {
        $_ENV[$key] = $value;
    }
    
}

/**
 * encryptUserID
 * Encrypts a user ID for use in URLs
 * @param  string $userID - The UUID to encrypt
 * @param  string $key - The encryption key
 * @return string - The encrypted user ID
 */
function encryptUserID($userID) {
    loadEnv();
    $key = $_ENV['SUID_SECRET_KEY'];
    // Generate a random nonce
    $nonce = random_bytes(SODIUM_CRYPTO_SECRETBOX_NONCEBYTES);

    // Encrypt the user ID
    $encrypted = sodium_crypto_secretbox($userID, $nonce, $key);

    // Encode the encrypted user ID and nonce
    $encoded = base64_encode($nonce . $encrypted);

    return urlencode($encoded);
}

/**
 * decryptUserID
 * Decrypts an encrypted user ID from a URL
 * @param  string $encryptedUserID - The encrypted user ID
 * @param  string $key - The decryption key
 * @return string - The decrypted user ID (UUID)
 */
function decryptUserID($encryptedUserID) {
    loadEnv();
    $key = $_ENV['SUID_SECRET_KEY'];
    // Decode the URL-encoded string
    $decoded = base64_decode(urldecode($encryptedUserID));

    // Extract the nonce and encrypted data
    $nonce = substr($decoded, 0, SODIUM_CRYPTO_SECRETBOX_NONCEBYTES);
    $encrypted = substr($decoded, SODIUM_CRYPTO_SECRETBOX_NONCEBYTES);

    // Decrypt the data
    $decrypted = sodium_crypto_secretbox_open($encrypted, $nonce, $key);

    return $decrypted !== false ? $decrypted : null;
}

