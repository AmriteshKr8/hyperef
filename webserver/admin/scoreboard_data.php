<?php
include 'auth_admin.php';
include 'creds.php';
$conn = new mysqli($host, $user, $passwd, $db);

echo '<table border="1">';
echo '<tr><th>School</th><th>Score</th><th>Question 1</th><th>Question 2</th><th>Question 3</th><th>Question 4</th><th>Question 5</th></tr>';

$sql = "SELECT * FROM leaderboard ORDER BY score DESC";
$result = $conn->query($sql);

while($row = $result->fetch_assoc()) {
    echo '<tr>';
    echo '<td>'. $row['schoolcode']. '</td>';
    echo '<td>'. $row['score']. '</td>';
    echo '<td>'. $row['q1']. '</td>';
    echo '<td>'. $row['q2']. '</td>';
    echo '<td>'. $row['q3']. '</td>';
    echo '<td>'. $row['q4']. '</td>';
    echo '<td>'. $row['q5']. '</td>';
    echo '</tr>';
}

echo '</table>';

$conn->close();
?>