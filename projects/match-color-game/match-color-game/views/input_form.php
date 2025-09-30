<!-- Input form for RGB values -->
<form class="rgb-input-form" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        
    <!-- Container holding the R, G, and B input fields -->
    <div class="input-fields-container">
        <input type="number" class="number-input" id="input-red" name="user_red" min="0" max="255" value="<?= $userRed ?>" required <?= $formDisabled ?>>
        <input type="number" class="number-input" id="input-green" name="user_green" min="0" max="255" value="<?= $userGreen ?>" required <?= $formDisabled ?>>
        <input type="number" class="number-input" id="input-blue" name="user_blue" min="0" max="255" value="<?= $userBlue ?>" required <?= $formDisabled ?>>
    </div>

    <!-- Container for R, G and B input field labels -->
    <div class="labels-container">
        <label for="input-red" class="red-text">R</label>
        <label for="input-green" class="green-text">G</label>
        <label for="input-blue" class="blue-text">B</label>
    </div>

    <!-- Container for Submit and Reset buttons -->
    <div class="buttons-container">
        <input type="submit" value="SUBMIT" class="form-button" <?= $formDisabled ?>>
        <input type="submit" name="reset_button" value="RESET" class="form-button" formnovalidate>
    </div>
</form> 