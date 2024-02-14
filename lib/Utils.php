<?php

// Utils.php
// Utility functions
// Author: kiduswb

require_once("vendor/autoload.php");

use Ramsey\Uuid\Uuid;

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
function generate_uuid() 
{    
    $uuid4 = Uuid::uuid4();
    return $uuid4->toString();
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
 * @return string - The encrypted user ID (hexadecimal)
 */
function encryptUserID($userID) {
    loadEnv();
    $key = $_ENV['SUID_SECRET_KEY'];
    // Generate a random initialization vector (IV)
    $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length('aes-256-cbc'));
    // Encrypt the user ID
    $encrypted = openssl_encrypt($userID, 'aes-256-cbc', $key, 0, $iv);
    // Convert the encrypted data to hexadecimal representation
    $hex = bin2hex($iv . $encrypted);
    return $hex;
}

/**
 * decryptUserID
 * Decrypts an encrypted user ID from a URL
 * @param  string $encryptedUserID - The encrypted user ID (hexadecimal)
 * @param  string $key - The decryption key
 * @return string - The decrypted user ID (UUID)
 */
function decryptUserID($encryptedUserID) {
    loadEnv();
    $key = $_ENV['SUID_SECRET_KEY'];
    // Convert the hexadecimal string back to binary
    $binary = hex2bin($encryptedUserID);
    // Extract the IV and encrypted data
    $iv = substr($binary, 0, openssl_cipher_iv_length('aes-256-cbc'));
    $encrypted = substr($binary, openssl_cipher_iv_length('aes-256-cbc'));
    // Decrypt the data
    $decrypted = openssl_decrypt($encrypted, 'aes-256-cbc', $key, 0, $iv);
    return $decrypted !== false ? $decrypted : null;
}


