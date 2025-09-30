<?php
// Load current session's target color
$targetRed = $_SESSION["target_red"];
$targetGreen = $_SESSION["target_green"];
$targetBlue = $_SESSION["target_blue"];

// Check if user guessed the correct color in last submission and
// save result in session variable
$_SESSION["is_match"] = ($userRed == $targetRed) &&
                        ($userGreen == $targetGreen) &&
                        ($userBlue == $targetBlue);

$isMatch = $_SESSION["is_match"];
                
// Decrement lives on each form submission, but only if user didn't find
// the correct color with last submission
if ($_SERVER["REQUEST_METHOD"] === "POST" && !$isMatch) {
    $_SESSION["lives_remaining"]--;
    
    // Ensure lives don't go negative
    if ($_SESSION["lives_remaining"] < 0) {
        $_SESSION["lives_remaining"] = 0;
    }
}

$livesRemaining = $_SESSION["lives_remaining"];

// Set flag to ensure form inputs and submission are disabled
// when user is out of lives or found the correct color
if ($livesRemaining <= 0 || $isMatch) {
    $formDisabled = "disabled";
} else {
    $formDisabled = "";
}