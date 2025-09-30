<?php
/**
 * Returns a hint based on how close the user's RGB value is to the target.
 *
 * - "PERFECT !" if it's an exact match
 * - "HOT ▲/▼" if very close (<= 5)
 * - "WARM ▲/▼" if moderately close (<= 25)
 * - "COLD ▲/▼" if far away (> 25)
 *
 * Also returns a direction arrow (▲ if user's value is too low, ▼ if too high)
 * and a matching CSS text color.
 *
 * @param int $userValue   User's RGB input (0–255)
 * @param int $targetValue Target RGB value (0–255)
 *
 * @return array{
 *     text: string, 
 *     text_color: string
 * }
 * - text:       Hint text like "HOT ▲" or "PERFECT !"
 * - text_color: CSS color style like "color: rgb(255, 0, 0);"
 */
function getColorHint(int $userValue, int $targetValue): array {
    $difference = abs($userValue - $targetValue);
    $arrow = $userValue > $targetValue ? "▼" : ($userValue < $targetValue ? "▲" : "");

    if ($difference == 0) return ["text" => "PERFECT !", "text_color" => "color: rgb(0, 255, 0);"];
    if ($difference <= 5) return ["text" => "HOT $arrow", "text_color" => "color: rgb(255, 0, 0);"];
    if ($difference <= 25) return ["text" => "WARM $arrow", "text_color" => "color: rgb(255, 125, 0);"];
    return ["text" => "COLD $arrow", "text_color" => "color: rgb(0, 217, 255);"];
}