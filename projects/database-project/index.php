<?php

function createTable(array $data, array|false $ueberschriften = false, string $farbe_1 = '#f9fafb', string $farbe_2 = '#ccd4db'): string
{
    $htmlString = "<table>";

    if ($ueberschriften) {
        foreach ($ueberschriften as $ueberschrift => $value) {
            $htmlString .= "<th>$ueberschrift</th>";
        }
        $htmlString .= "<th>DELETE</th>";
    }

    foreach ($data as $index => $dataSet) {
        $htmlString .= "<tr>";
        $colorStyleTag = "style=\"background-color: " . ($index % 2 == 0 ? $farbe_1 : $farbe_2) . ";\"";

        foreach ($dataSet as $key => $value) {
            if ($key === 'ip') {
                $htmlString .= "<td $colorStyleTag><a href=\"http://$value\" target=\"_blank\">$value</a></td>";
            } else {
                $htmlString .= "<td $colorStyleTag>$value</td>";
            }
        }

        $htmlString .= "<td><a href='#'>Delete</a></td>";
        $htmlString .= "</tr>";
    }

    $htmlString .= "</table>";

    return $htmlString;
}

// Database connection credentials
$host = "localhost";
$dbname = "company";
$username = "phpstorm";
$password = "p@ssw0rt";

// Try to establish connection, catch connection failures
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false
    ]);

    //error_log("Connected successfully to MariaDB!" . "<br>");
} catch (PDOException $e) {
    //echo "Connection failed: " . $e->getMessage();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // SQL Injection Prevention
    $fname = htmlspecialchars($_POST["fname"]);
    $lname = htmlspecialchars($_POST["lname"]);

    // Prepare INSERT statement with placeholders for column values
    $stmt = $pdo->prepare("INSERT INTO employees (fname, lname) VALUES (:fname, :lname)");

    // Bind placeholders to php variables containing the respective value
    $stmt->bindParam(":fname", $fname);
    $stmt->bindParam(":lname", $lname);

    // Execute and send statement to database
    $stmt->execute();
}

$stmt = $pdo->prepare("SELECT * FROM employees");
$stmt->execute();
$data = $stmt->fetchAll();
$htmlTable = createTable($data, $data[0]);

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
                <?= $htmlTable ?>
            </div>
        </div>

    </main>
</div>
</body>
</html>