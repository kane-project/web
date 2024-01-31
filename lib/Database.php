<?php

// Database.php
// This script handles database connection and queries
// Author: kiduswb

require_once("Utils.php");

/**
 * sqlQuery
 * This function handles SQL queries
 * PDO is used for database connection
 * @param  mixed $query - The query to be executed
 * @param  mixed $params - The parameters to be passed to the query
 * @return PDOStatement
 */
function sqlQuery($query, $params = [])
{ 
    loadEnv();
    
    try 
    {
        $pdo = new PDO(
            "mysql:host=" . $_ENV['DB_HOST'] . ";dbname=" . $_ENV['DB_NAME'],
            $_ENV['DB_USER'],
            $_ENV['DB_PASS']
        );

        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = $pdo->prepare($query);
        $stmt->execute($params);
        $pdo = null;
        return $stmt;
    } 
    
    catch (PDOException $e) 
    {
        throw new Exception("<pre>DBERROR - Please contact the site administrator!</pre>");
    }
}