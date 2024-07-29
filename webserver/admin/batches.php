<?php
include 'auth_admin.php';
include 'creds.php';
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

function tableExistsAndNotEmpty($conn, $tableName) {
    $checkTableQuery = "SHOW TABLES LIKE '$tableName'";
    $result = $conn->query($checkTableQuery);
    if ($result->num_rows > 0) {
        $checkEmptyQuery = "SELECT COUNT(*) as count FROM $tableName";
        $result = $conn->query($checkEmptyQuery);
        $row = $result->fetch_assoc();
        return $row['count'] > 0;
    }
    return false;
}

function getTableContent($conn, $tableName) {
    $query = "SELECT * FROM $tableName";
    $result = $conn->query($query);
    $rows = [];
    while ($row = $result->fetch_assoc()) {
        $rows[] = $row;
    }
    return $rows;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Batch Leaderboards</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>

<nav>
    <ul>
        <li><a href="precontest.php">Database Management</a></li>
        <li><a href="during_contest.php">Contest status</a></li>
        <li><a href="scoreboard.php">Scoreboard</a></li>
        <li><a href="batches.php">Batch Leaderboards</a></li>
    </ul>
</nav>
<style>
nav {
    background-color: #333;
}

nav ul {
    list-style-type: none;
    margin: 0;
    padding: 0;
    overflow: hidden;
}

nav li {
    float: left;
}

nav li a {
    display: block;
    color: white;
    text-align: center;
    padding: 14px 16px;
    text-decoration: none;
}

nav li a:hover {
    background-color: #111;
}
</style>

<?php
echo "<fieldset><legend>Batch Leaderboards</legend>";
for ($i = 1; $i <= 10; $i++) {
    $tableName = "L" . $i;
    if (tableExistsAndNotEmpty($conn, $tableName)) {
        $tableContent = getTableContent($conn, $tableName);
        echo "<h2>Table $tableName</h2>";
        echo "<table>";
        echo "<tr>";
        foreach ($tableContent[0] as $column => $value) {
            echo "<th>$column</th>";
        }
        echo "</tr>";
        foreach ($tableContent as $row) {
            echo "<tr>";
            foreach ($row as $value) {
                echo "<td>$value</td>";
            }
            echo "</tr>";
        }
        echo "</table><br>";
    }
}
echo "</fieldset>";

echo "<fieldset><legend>Batch Submissions</legend>";
for ($i = 1; $i <= 10; $i++) {
    $tableName = "S" . $i;
    if (tableExistsAndNotEmpty($conn, $tableName)) {
        $tableContent = getTableContent($conn, $tableName);
        echo "<h2>Table $tableName</h2>";
        echo "<table>";
        echo "<tr>";
        foreach ($tableContent[0] as $column => $value) {
            echo "<th>$column</th>";
        }
        echo "</tr>";
        foreach ($tableContent as $row) {
            echo "<tr>";
            foreach ($row as $value) {
                echo "<td>$value</td>";
            }
            echo "</tr>";
        }
        echo "</table><br>";
    }
}
echo "</fieldset>";

$conn->close();
?>

</body>
</html>
