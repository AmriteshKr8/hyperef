<?php
include 'auth_admin.php';
include 'creds.php';

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$query = "SELECT * FROM submissions";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    echo "<table>";
    echo "<tr><th>schoolcode</th><th>time</th><th>question</th></tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr><td>{$row['schoolcode']}</td><td>{$row['time']}</td><td>{$row['question']}</td></tr>";
    }
    echo "</table>";
} else {
    echo "Submissions are empty.";
}

$conn->close();
?>
