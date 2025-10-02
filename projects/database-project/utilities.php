<?php

function createDBConnection(string $host='localhost', string $user='phpstorm', $password='p@ssw0rt', $database='company'): PDO|null {
    try {
        return new PDO("mysql:host=$host;dbname=$database;charset=utf8mb4", $user, $password);
    }
    catch (PDOException $e) {
        echo "Connection to database failed.<br>" . $e->getMessage() . "<br>";
        return null;
    }
}

function createTable(array $data, array|false $ueberschriften = false, string $farbe_1 = '#f9fafb', string $farbe_2 = '#ccd4db'): string
{
    $htmlString = "<table>";

    if ($ueberschriften) {
        foreach ($ueberschriften as $ueberschrift => $value) {
            $htmlString .= "<th>$ueberschrift</th>";
        }
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

        $id = $dataSet['id'];
        $htmlString .= "<td><a href=\"./processDelete.php?id={$id}\">Delete</a></td>";
        $htmlString .= "<td><a href=\"./processUpdate.php?id={$id}\">Update</a></td>";
        $htmlString .= "</tr>";
    }

    $htmlString .= "</table>";

    return $htmlString;
}

function displayTable(PDO $dbConnection): string {
    $stmt = $dbConnection->prepare("SELECT * FROM employees");
    $stmt->execute();
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return createTable($data, $data[0]);
}