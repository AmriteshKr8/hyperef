<?php
if (isset($_COOKIE['key'])) {
    $cookieValue = $_COOKIE['key'];
    $info = base64_decode($cookieValue);
    $info_data = explode("^", $info);
    $name = $info_data[0];
    $pass = $info_data[1];
}
include '/admin/creds.php';

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

try {
    $sql = "SELECT response as reply FROM queries where tcode = '$name' order by time desc limit 1";
    $result = $conn->query($sql);

    if (!$result) {
        throw new Exception("Query failed: " . $conn->error);
    }

    $rows = [];
    while ($row = $result->fetch_assoc()) {
        $rows[] = $row;
    }
} catch (Exception $e) {
    echo json_encode(['error' => $e->getMessage()]);
    exit();
}
echo json_encode($rows[0]);
$conn->close();
?>