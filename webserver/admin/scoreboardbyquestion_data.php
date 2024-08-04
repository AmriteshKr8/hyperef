<?php
include 'auth_admin.php';
include 'creds.php';
$conn = new mysqli($host, $user, $passwd, $db);
$sql = "select id from questions";
$result = $conn->query($sql);
$qno = $result->num_rows;
for($i=1;$i<=$qno;$i++){
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