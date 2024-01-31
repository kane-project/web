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
    
    catch (UnsatisfiedDependencyException $e) 
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