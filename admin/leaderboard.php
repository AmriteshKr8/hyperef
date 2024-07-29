<?php
include 'auth_admin.php';
include 'creds.php';
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$query = "SELECT * FROM leaderboard";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    echo "<table>";
    echo "<tr><th>schoolcode</th><th>score</th><th>question 1</th><th>question 2</th><th>question 3</th><th>question 4</th><th>question 5</th></tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr><td>{$row['schoolcode']}</td><td>{$row['score']}</td><td>{$row['q1']}</td><td>{$row['q2']}</td><td>{$row['q3']}</td><td>{$row['q4']}</td><td>{$row['q5']}</td></tr>";
    }
    echo "</table>";
} else {
    echo "Leaderboard is empty.";
}

$conn->close();
?>
