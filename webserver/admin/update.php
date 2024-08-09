<?php
include 'auth_admin.php';
include 'creds.php';
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$file = 'uyi7y8787tyguhjhg876/test.txt';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['start'])) {
        file_put_contents($file, 'c2h1cnUgaG8gZ2F5YSBiZW5jaG8=');
        $stmt = $conn->prepare("INSERT INTO submissions (schoolcode, question, score) VALUES (?, ?, ?)");
        $stmt->bind_param("sii", $schoolcode, $question, $score);
        $schoolcode = 'system';
        $question = 99;
        $score = 10;
        $stmt->execute();
        $stmt->close();
    } elseif (isset($_POST['end'])) {
        file_put_contents($file, 'a2hhdGFtIGhvIGdheWEgYmVuY2hv');
        $stmt = $conn->prepare("INSERT INTO submissions (schoolcode, question, score) VALUES (?, ?, ?)");
        $stmt->bind_param("sii", $schoolcode, $question, $score);
        $schoolcode = 'system';
        $question = 100;
        $score = 10;
        $stmt->execute();
        $stmt->close();
    } elseif (isset($_POST['number'])) {
        $number = intval($_POST['number']);
        $newSubmissions = "S" . $number;
        $conn->query("CREATE TABLE $newSubmissions AS SELECT * FROM submissions");
        $conn->query("TRUNCATE TABLE submissions");
        echo "Data copied to table $newSubmissions.";
    } elseif (isset($_POST['truncate'])) {
        $conn->query("TRUNCATE TABLE submissions");
    }
}

$conn->close();
?>
