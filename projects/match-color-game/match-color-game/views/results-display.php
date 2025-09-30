<?php
// Load current session's target color values
$targetRed = $_SESSION["target_red"];
$targetGreen = $_SESSION["target_green"];
$targetBlue = $_SESSION["target_blue"];

// Load current POST data for user color values
$userRed = $_POST["user_red"];
$userGreen = $_POST["user_green"];
$userBlue = $_POST["user_blue"];

// Load current session's flag indicating if user matched the 
// target color
$isMatch = $_SESSION["is_match"];

// Load current session's remaining lives
$livesRemaining = $_SESSION["lives_remaining"];

// Generate appropriate hints to display for the user's entered RGB values
require_once "./logic/get_color_hint.php";
$hintRed = getColorHint($userRed, $targetRed);
$hintGreen = getColorHint($userGreen, $targetGreen);
$hintBlue = getColorHint($userBlue, $targetBlue);
?>

<div class="results-container">
    <!-- Display for user-generated color -->
    <h2 class="your-color-text">YOUR COLOR</h2>
    
    <!-- Outer container for extra border around user color display -->
    <div class="user-color-display-container">
        <div class="user-color-display" style="background-color: rgb(<?= $userRed ?>, <?= $userGreen ?>, <?=$userBlue ?>);
                    border-color: rgb(<?= $userRed + 40 ?>, <?= $userGreen + 40 ?>, <?= $userBlue + 40 ?>);">
        </div>
    </div>

    <!-- Display hint section for user's entered RGB values (hot, warm or cold) or
         display victory message if user guessed the correct color or
         display loss message if user ran out of lives 
    -->
    <?php
    if ($livesRemaining <= 0 && !$isMatch) { ?>
        <div class="loss-message-display">
            <h2 class="loss-message">OUT OF LIVES<br>TOO BAD!</h2>
        </div>
    <?php 
    } elseif ($isMatch) { ?>
        <div class="victory-message-display">
            <h2 class="victory-message">PERFECT MATCH<br>CONGRATS!</h2>
        </div>
    <?php 
    } else { ?>
        <div class="red-result">
            <span class="text-red">RED</span>
            <span class="hint-red" style="<?= $hintRed["text_color"] ?>"><?= $hintRed["text"] ?></span>
        </div>
                    
        <div class="green-result">
            <span class="text-green">GREEN</span>
            <span class="hint-green" style="<?= $hintGreen["text_color"] ?>"><?= $hintGreen["text"] ?></span>
        </div>

        <div class="blue-result">
            <span class="text-blue">BLUE</span>
            <span class="hint-blue" style="<?= $hintBlue["text_color"] ?>"><?= $hintBlue["text"] ?></span>
        </div>
    <?php } ?>
</div>