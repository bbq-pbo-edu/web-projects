<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
            <div class="card-content">
                <div class="balls-display">
                    <h3>Your Balls</h3>
                    <div class="balls-container">
                        <div class="green-ball-display"><p>x<sub>_</sub>X</p></b></div>
                        <div class="blue-ball-display"><p>^_^</p></div>
                    </div>
                    <div class="attempts-display">
                        <p>Attempts: <b>0</b></p>
                        <p>Balls Broken: <b>0</b></p>
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
                        Choose a floor: <span class="floor-display">50</span>
                    </label>
                    <input type="range" min="0" max="100" name="floor-slider" id="floor-slider">
                </div>
                <div class="balls-control-group">
                    <p>Choose a ball:</p>
                    <div class="balls-radio-container">
                        <div class="balls-radio-group">
                            <input type="radio" name="ball-choice" id="green-ball-radio" checked>
                            <label for="green-ball-radio">Green Ball</label>
                        </div>
                        <div class="balls-radio-group">
                            <input type="radio" name="ball-choice" id="blue-ball-radio">
                            <label for="blue-ball-radio">Blue Ball</label>
                        </div>
                    </div>
                </div>
                <div class="controls-button-group">
                    <button type="submit" name="btn-drop" class="btn-drop">Drop Ball</button>
                    <button type="submit" name="btn-reset" class="btn-reset">Reset Simulation</button>
                </div>
            </form>
            <div class="separator"></div>
            <form id="strategy-form" action="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="GET">
                <h2>Bulk Run</h2>
                <div class="strategy-control-group">
                    <label for="strategy-choice">Select a Strategy:</label>
                    <select name="strategy-choice" id="strategy-choice">
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
                    <button type="submit" name="btn-run-bulk" class="btn-run-bulk">Run 1000 Simulations</button>
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
                </div>
            </form>
        </div>
    </aside>
</div>
</body>
</html>