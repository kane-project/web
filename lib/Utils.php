<?php

// Utils.php
// Just a bunch of utilities for the site
// Author: kiduswb

/**
 * slugify
 * Returns a slugified version of the string for use in URLs
 * @param  string $string - the string to slugify
 * @return string
 */
function slugify($string) {
    $string = strtolower($string);
    $string = preg_replace("/[^a-z0-9_\s-]/", "", $string);
    $string = preg_replace("/[\s-]+/", " ", $string);
    $string = preg_replace("/[\s_]/", "-", $string);
    return $string. "-" . rand(1000, 9999);
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
        putenv("$key=$value");
    }
}