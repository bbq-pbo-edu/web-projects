<?php
// Initialize session and current game data (e.g. target color, remaining lives)
require_once "./logic/init.php";

// Process submitted POST data
require_once "./logic/process_input.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="./styles/styles.css">
    <title>MATCH THE COLOR</title>
</head>
<body>
    <!-- Main Container with all UI Elements inside -->
    <div class="main-container">
        <h1 class="title">MATCH THE COLOR</h1>

        <!-- Load views to display different sections of the UI -->
        <?php include "./views/lives_display.php"; ?>
        <?php include "./views/target_color_display.php"; ?>
        <?php include "./views/input_form.php"; ?>

        <!-- Load results display view only if user submitted POST data -->
        <?php if ($_SERVER["REQUEST_METHOD"] === "POST") include "./views/results-display.php"; ?>
    </div>
</body>
</html>