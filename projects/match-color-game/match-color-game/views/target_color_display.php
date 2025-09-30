<?php
// Load current session's target color values
$targetRed = $_SESSION["target_red"];
$targetGreen = $_SESSION["target_green"];
$targetBlue = $_SESSION["target_blue"];
?>

<!-- Display for randomly generated target color, surrounded by an extra 
     container with a border-->
<div class="target-color-display-container">
    <div class="target-color-display" 
         style="background-color: rgb(<?= $targetRed ?>, <?= $targetGreen ?>, <?= $targetBlue ?>);
                border-color: rgb(<?= $targetRed + 40 ?>, <?= $targetGreen + 40 ?>, <?= $targetBlue + 40 ?>);">
    </div>
</div>