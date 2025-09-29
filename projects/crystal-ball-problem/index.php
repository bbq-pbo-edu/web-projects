<?php
session_start();

if (isset($_GET['btn-reset'])) {
    unset($_SESSION['safe-floors']);
    unset($_SESSION['unsafe-floors']);
    unset($_SESSION['balls-broken']);
    unset($_SESSION['balls-dropped']);
    unset($_SESSION['breakpoint-floor']);
    unset($_SESSION['green-ball-face']);
    unset($_SESSION['blue-ball-face']);
    unset($_SESSION['is-green-broken']);
    unset($_SESSION['is-blue-broken']);
}

$_SESSION['safe-floors'] = $_SESSION['safe-floors'] ?? [];
$_SESSION['unsafe-floors'] = $_SESSION['unsafe-floors'] ?? [];
$_SESSION['balls-broken'] = $_SESSION['balls-broken'] ?? 0;
$_SESSION['balls-dropped'] = $_SESSION['balls-dropped'] ?? 0;
$_SESSION['breakpoint-floor'] = $_SESSION['breakpoint-floor'] ?? '64';
$_SESSION['green-ball-face'] = $_SESSION['green-ball-face'] ?? '^_^';
$_SESSION['blue-ball-face'] = $_SESSION['blue-ball-face'] ?? '^_^';
$_SESSION['is-green-broken'] = $_SESSION['is-green-broken'] ?? false;
$_SESSION['is-blue-broken'] = $_SESSION['is-blue-broken'] ?? false;

if (isset($_GET['btn-drop'])) {
    $_SESSION['balls-dropped']++;
    $_SESSION['balls-broken'] += $_GET['floor-slider'] >= '64' ? 1 : 0;

    if ($_GET['ball-choice'] == 'green-ball') {
        $greenBallAnimation = "green-ball-falling-" . ceil($_GET['floor-slider'] / 10) * 10;
    } else {
        $greenBallAnimation = "";
        if ($_GET['ball-choice'] == 'blue-ball') {
            $blueBallAnimation = "blue-ball-falling-" . ceil($_GET['floor-slider'] / 10) * 10;
        } else {
            $blueBallAnimation = "";
        }
    }

    if ($_GET['floor-slider'] >= 64) {
        if (!in_array($_GET['floor-slider'], $_SESSION['unsafe-floors'])) {
            $_SESSION['unsafe-floors'][] = $_GET['floor-slider'];
        }

        if ($_GET['ball-choice'] == 'green-ball') {
            $_SESSION['is-green-broken'] = true;
        } else if ($_GET['ball-choice'] == 'blue-ball') {
            $_SESSION['is-blue-broken'] = true;
        }

        $_SESSION['green-ball-face'] = $_GET['ball-choice'] == 'green-ball' || $_SESSION['is-green-broken'] ? 'x<sub>_</sub>X' : '^_^';
        $_SESSION['blue-ball-face'] = $_GET['ball-choice'] == 'blue-ball' || $_SESSION['is-blue-broken'] ? 'x<sub>_</sub>X' : '^_^';
    } else {
        if (!in_array($_GET['floor-slider'], $_SESSION['safe-floors'])) {
            $_SESSION['safe-floors'][] = $_GET['floor-slider'];
        }
    }

    $safeFloorsDisplay = "";
    foreach ($_SESSION['safe-floors'] as $floor) {
        $safeFloorsDisplay .= $floor . ', ';
    }

    $unsafeFloorsDisplay = "";
    foreach($_SESSION['unsafe-floors'] as $floor) {
        $unsafeFloorsDisplay .= $floor . ', ';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/tokens/colors.css">
    <link rel="stylesheet" href="css/style.css">
    <title>Crystal Ball Problem</title>
</head>
<body>
<div class="container">
    <nav class="sidebar">
        <div class="logo">
            <img src="../../portfolio-website/assets/icons/main-icon.svg" alt="main icon" width="48px" height="48px">
        </div>
        <ul class="menu">
            <li class="nav-item">
                <a href="../../portfolio-website">Home</a>
            </li>
            <li class="nav-item">
                <a href="#">placeholder</a>
            </li>
            <li class="nav-item">
                <a href="#">placeholder</a>
            </li>
        </ul>
        <div class="profile-picture">
            <img src="../../portfolio-website/assets/icons/profile-pic-icon.svg" alt="profile picture" width="48px"
                 height="48px">
        </div>
    </nav>
    <main>
        <header>
            <h1>Crystal Ball Problem</h1>
            <p>An interactive experiment to find the optimal strategy for the two crystal balls puzzle.</p>
        </header>
        <div class="simulation-card">
            <div class="card-title">
                <h2>Simulation</h2>
            </div>
            <div class="floors-result-display">
                <p>Safe Floors: <b><?= $safeFloorsDisplay ?></b></p>
                <p>Unsafe Floors: <b><?= $unsafeFloorsDisplay ?></b></p>
            </div>
            <div class="card-content">
                <div class="balls-display">
                    <h3>Your Balls</h3>
                    <div class="balls-container">
                        <div class="green-ball-display" style="animation: <?= $greenBallAnimation ?> 5s;"><p class="ball-face"><?= $_SESSION['green-ball-face'] ?></p></div>
                        <div class="blue-ball-display" style="animation: <?= $blueBallAnimation ?> 5s;"><p class="ball-face"><?= $_SESSION['blue-ball-face'] ?></p></div>
                    </div>
                    <div class="attempts-display">
                        <p>Balls Dropped: <b><?= $_SESSION['balls-dropped'] ?></b></p>
                        <p>Balls Broken: <b><?= $_SESSION['balls-broken'] ?></b></p>
                    </div>
                </div>
                <div class="house-container">
                    <div class="house"></div>
                    <p><b>100-Floor-Building</b></p>
                </div>
            </div>
        </div>
    </main>
    <aside>
        <div class="controls-card">
            <form id="controls-form" action="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="GET">
                <h2>Controls</h2>
                <div class="range-control-group">
                    <label for="floor-slider">
                        Choose a floor: <span id="floor-display"></span>
                    </label>
                    <input type="range" min="1" max="100" name="floor-slider" id="floor-slider" value="50">
                </div>
                <div class="balls-control-group">
                    <p>Choose a ball:</p>
                    <div class="balls-radio-container">
                        <div class="balls-radio-group">
                            <input type="radio" name="ball-choice" id="green-ball-radio" value="green-ball" required <?= $_GET['ball-choice'] == 'green-ball' || $_SESSION['is-blue-broken'] && !$_SESSION['is-green-broken'] ? 'checked' : '' ?> <?= $_SESSION['is-green-broken'] ? 'disabled' : '' ?>>
                            <label for="green-ball-radio">Green Ball</label>
                        </div>
                        <div class="balls-radio-group">
                            <input type="radio" name="ball-choice" id="blue-ball-radio" value="blue-ball" required <?= $_GET['ball-choice'] == 'blue-ball' || $_SESSION['is-green-broken'] && !$_SESSION['is-blue-broken'] ? 'checked' : '' ?> <?= $_SESSION['is-blue-broken'] ? 'disabled' : '' ?>>
                            <label for="blue-ball-radio">Blue Ball</label>
                        </div>
                    </div>
                </div>
                <div class="controls-button-group">
                    <button type="submit" name="btn-drop" class="btn-drop" <?= $_SESSION['balls-broken'] >= 2 ? "disabled" : "" ?>>Drop Ball</button>
                    <button type="submit" name="btn-reset" class="btn-reset">Reset Simulation</button>
                </div>
            </form>
            <div class="separator"></div>
            <form id="strategy-form" action="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="GET">
                <h2>Bulk Run (unfinished)</h2>
                <div class="strategy-control-group">
                    <label for="strategy-choice">Select a Strategy:</label>
                    <select name="strategy-choice" id="strategy-choice" disabled>
                        <option value="optimal-strategy">Optimal Strategy</option>
                        <option value="fixed-interval-strategy">Fixed-interval (k-step)</option>
                        <option value="linear-strategy">Linear search (one-by-one)</option>
                    </select>
                    <p class="explanation">
                        <b>How it works:</b><br>
                        Drop the first ball at decreasing intervals (floor 14, then 27, 39, etc.). This balances the
                        work
                        between the two balls to minimize the worst-case scenario.<br>
                        <b>Worst-case-drops:</b><br>
                        14 drops
                    </p>
                </div>
                <div class="bulk-button-group">
                    <button type="submit" name="btn-run-bulk" class="btn-run-bulk" disabled>Run 1000 Simulations</button>
                </div>
                <div class="bulk-result-display">
                    <div class="bulk-success">
                        <p class="result-label">Success</p>
                        <p class="result-value">-</p>
                    </div>
                    <div class="bulk-fail">
                        <p class="result-label">Fail</p>
                        <p class="result-value">-</p>
                    </div>
                    <div class="bulk-average">
                        <p class="result-label">Drop &#8709;</p>
                        <p class="result-value">-</p>
                    </div>
                    <div class="bulk-worst-case">
                        <p class="result-label">Worst Case</p>
                        <p class="result-value">-</p>
                    </div>
                </div>
            </form>
        </div>
    </aside>
</div>
<script src="./js/slider-value.js"></script>
</body>
</html>