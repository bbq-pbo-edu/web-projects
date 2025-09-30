<!-- Display for user's current lives -->
<div class="lives-display">
    <?php for ($i = 0; $i < $_SESSION["lives_remaining"]; $i++) {?>
        <img src="./images/heart_retro_32.png" alt="heart icon" width="32px" height="32px">
    <?php } ?>
</div>