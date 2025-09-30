<?php
// Start a session and set session variables
session_start();

// If page reloaded via any other method but POST (Refresh, F5, etc.)
// free up stored session values for target color
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    unset($_SESSION["target_red"]);
    unset($_SESSION["target_green"]);
    unset($_SESSION["target_blue"]);
}

// Reset session and reload page when Reset Button was clicked
if (isset($_POST["reset_button"])) {
    session_unset();
    header("Location: " . $_SERVER["PHP_SELF"]);
    exit();
}

// Set variables of R, G and B user input to current POST values or 0 if
// no POST values are set (e.g. when session is new or reset)
$userRed = isset($_POST["user_red"]) ? $_POST["user_red"] : 0;
$userGreen = isset($_POST["user_green"]) ? $_POST["user_green"] : 0;
$userBlue = isset($_POST["user_blue"]) ? $_POST["user_blue"] : 0;

// Set variables for randomly generated color's R, G and B values to 
// stored session values or generate each value randomly if no session
// values exist
if (
    !isset($_SESSION["target_red"]) ||
    !isset($_SESSION["target_green"]) ||
    !isset($_SESSION["target_blue"])
) {
    $_SESSION["target_red"] = random_int(0, 255);
    $_SESSION["target_green"] = random_int(0, 255);
    $_SESSION["target_blue"] = random_int(0, 255);
}

// Set user's remaining lives to 3 if no session value exists
if (!isset($_SESSION["lives_remaining"])) {
    $_SESSION["lives_remaining"] = 3;
}

// Initialize flag for correctly matched color to false if not already
// set
if (!isset($_SESSION["is_match"])) {
    $_SESSION["is_match"] = false;
}