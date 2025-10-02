<?php

require_once "./utilities.php";

$conn = createDBConnection();

$fname = htmlspecialchars($_POST["fname"]);
$lname = htmlspecialchars($_POST["lname"]);

// Prepare INSERT statement with placeholders for column values
$stmt = $conn->prepare("INSERT INTO employees (fname, lname) VALUES (:fname, :lname)");

// Bind placeholders to php variables containing the respective value
$stmt->bindParam(":fname", $fname);
$stmt->bindParam(":lname", $lname);

// Execute and send statement to database
$stmt->execute();