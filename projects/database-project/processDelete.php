<?php

require_once "./utilities.php";

$id = $_GET['id'];

$conn = createDBConnection();
$stmt = $conn->prepare("DELETE FROM employees WHERE id = :id");
$stmt->bindParam(':id', $id);
$stmt->execute();

header("Location: ./");