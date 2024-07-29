<?php
include 'auth_admin.php';
include 'creds.php';

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

for ($i = 1; $i <= 10; $i++) {
    $tableName = "L" . $i;
    $checkTableQuery = "SHOW TABLES LIKE '$tableName'";
    $result = $conn->query($checkTableQuery);
    $row = $result->fetch_assoc();
    
    if ($row['count'] > 0) {
        $selectQuery = "SELECT * FROM $tableName";
        $result = $conn->query($selectQuery);

        echo '<table border="1">';
        echo '<tr><th>Schoolcode</th><th>Question</th><th>Question 1</th><th>Question 2</th><th>Question 3</th><th>Question 4</th><th>Question 5</th></tr>';
        
        while ($row = $result->fetch_assoc()) {
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
    }
}

$conn->close();
?>
