<?php
// Database connection credentials
$host = "localhost";
$dbname = "company";
$username = "company_admin";
$password = "p@ssw0rt";

// Try to establish connection, catch connection failures
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false
    ]);

    echo "Connected successfully to MariaDB!";
}

catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

$pdo->exec("CREATE DATABASE IF NOT EXISTS company");
$pdo->exec("USE company");
$pdo->exec("CREATE TABLE IF NOT EXISTS employee (fname VARCHAR(255), lname VARCHAR(255))");
$pdo->exec("INSERT INTO employee (fname, lname) VALUES ('John', 'Doe')");
$pdo->exec("INSERT INTO employee (fname, lname) VALUES('Jane', 'Doe')");
$pdo->exec("INSERT INTO employee (fname, lname) VALUES('Joe', 'Doe')");