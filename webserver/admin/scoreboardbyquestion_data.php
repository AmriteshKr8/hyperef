<?php
include 'auth_admin.php';
include 'creds.php';
$conn = new mysqli($host, $user, $passwd, $db);
for($i=1;$i<=5;$i++){
    $sql = "select schoolcode, question, time from submissions where question = $i limit 3";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        echo '<table border="1">';
        echo'<h1>Question '.$i.'</h1>';
        echo '<tr><th>School</th><th>Time of Submission</th></tr>';
        while($row = $result->fetch_assoc()) {
            echo '<tr>';
            echo '<td>'. $row['schoolcode']. '</td>';
            echo '<td>'. $row['time']. '</td>';
            echo '</tr>';
        }
        echo '</table>';
    }
}
$conn->close();
?>