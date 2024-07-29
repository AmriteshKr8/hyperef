<?php
include 'creds.php';
$conn = new mysqli($host, $user, $passwd, $db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$out = [];
for($i=1;$i<6;$i++){
    $entries_read = $conn->prepare("SELECT q$i FROM leaderboard WHERE q$i IS NOT NULL");
    $entries_read->execute();
    $insertrez = $entries_read->get_result();
    $entries = $insertrez->num_rows;
    $out['qa'.$i] = $entries;
}
echo json_encode($out);
$entries_read->close();
$conn->close();
?>