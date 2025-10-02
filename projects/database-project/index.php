<?php

require_once "./utilities.php";
$conn = createDBConnection();

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css">
    <title>Database Project</title>
</head>
<body>
<div class="container">
    <nav class="sidebar">
        <div class="logo">
            <img src="../../portfolio-website/assets/icons/main-icon.svg" alt="main icon" width="48px" height="48px">
        </div>
        <ul class="menu">
            <li class="nav-item active">
                <a href="http://10.101.105.170/portfolio-website">Home</a>
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
        <h1>Database Project</h1>
        <p>A simple form to create new database entries.</p>
        <div class="app-container">
            <div class="create-container">
                <form id="input-form" action="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>" ) method="POST">
                    <div class="form-group">
                        <label for="fname">First Name</label>
                        <input type="text" id="fname" name="fname" required>
                    </div>
                    <div class="form-group">
                        <label for="lname">Last Name</label>
                        <input type="text" id="lname" name="lname" required>
                    </div>
                    <button type="submit" form="input-form">Send to Database</button>
                </form>
            </div>
            <div class="table-container">
                <?= displayTable($conn) ?>
            </div>
        </div>

    </main>
</div>
</body>
</html>