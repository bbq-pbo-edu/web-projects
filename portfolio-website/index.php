<?php
require_once "./data/students-data.php";

?>
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Patricks Portfolio</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <nav class="sidebar">
        <div class="logo">
            <img src="./assets/icons/main-icon.svg" alt="main icon" width="48px" height="48px">
        </div>
        <ul class="menu">
            <li class="nav-item active">
                <a href="#">Home</a>
            </li>
            <li class="nav-item">
                <a href="#">placeholder</a>
            </li>
            <li class="nav-item">
                <a href="#">placeholder</a>
            </li>
        </ul>
        <div class="profile-picture">
            <img src="./assets/icons/profile-pic-icon.svg" alt="profile picture" width="48px" height="48px">
        </div>
    </nav>
    <main class="main">
        <h1>Portfolio</h1>
        <p class="bio">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus vulputate, nisl at bibendum
            fermentum, nibh risus consectetur urna, at imperdiet justo enim nec mauris. Curabitur sit amet nisl eu odio
            vehicula tincidunt vitae eu justo. Integer ullamcorper lectus et ante feugiat, id convallis orci tempor.<br><br>Praesent
            vel turpis at orci pretium pretium.
        </p>

        <div class="ip-table-container">
            <h2>Other Sites</h2>
            <table class="ip-table">
                <tr>
                    <th>Name</th>
                    <th>Vorname</th>
                    <th>Domain</th>
                    <th>Webserver IP</th>
                </tr>
                <?php for ($i = 0; $i < count($users); $i++) { ?>
                    <tr>
                        <td><?= $users[$i]['lastname'] ?></td>
                        <td><?= $users[$i]['firstname'] ?></td>
                        <td><a href='http://<?= $users[$i]['domain'] ?>'><?= $users[$i]['domain'] ?></a></td>
                        <td><a href='http://<?= $users[$i]['ip'] ?>' target='_blank'><?= $users[$i]['ip'] ?></a></td>
                    </tr>
                <?php } ?>
            </table>
        </div>
    </main>
    <aside class="projects-section">
        <ul class="projects-list">
            <li class="project-card">
                <a href="../projects/crystal-ball-problem/">
                    <div class="project-icon">
                        <img src="./assets/icons/project-crystal-balls-icon.svg"
                             alt="crystal ball project icon"
                             width="32px" height="32px">
                    </div>
                    <div class="project-title">Crystal Ball Problem</div>
                </a>
            </li>
            <li class="project-card">
                <a href="../projects/tic-tac-toe/">
                    <div class="project-icon">
                        <img src="./assets/icons/tic-tac-toe-icon.svg"
                             alt="tic-tac-toe icon"
                             width="32px" height="32px">
                    </div>
                    <div class="project-title">Tic Tac Toe</div>
                </a>
            </li>
            <li class="project-card">
                <a href="../phpinfo/" target="_blank">
                    <div class="project-icon">
                        <img src="./assets/icons/project-placeholder-icon.svg"
                             alt="project placeholder icon"
                             width="32px" height="32px">
                    </div>
                    <div class="project-title">phpinfo</div>
                </a>
            <li class="project-card">
                <a href="../projects/conf-reader/">
                    <div class="project-icon">
                        <img src="./assets/icons/project-placeholder-icon.svg"
                             alt="project placeholder icon"
                             width="32px" height="32px">
                    </div>
                    <div class="project-title">kea-conf-reader</div>
                </a>
            <li class="project-card">
                <a href="../projects/match-color-game/match-color-game" target="_blank">
                    <div class="project-icon">
                        <img src="./assets/icons/project-placeholder-icon.svg"
                             alt="project placeholder icon"
                             width="32px" height="32px">
                    </div>
                    <div class="project-title">Match The Color Game</div>
                </a>
            </li>
        </ul>
    </aside>
</div>
</body>
</html>
