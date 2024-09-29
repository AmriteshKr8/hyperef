<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $question = htmlspecialchars($_POST['question']);
    $tcode = htmlspecialchars($_POST['tcode']);
    if((strlen($question) == 0) or (strlen($tcode) == 0)){
        echo "Invalid Request";
        exit();
    }
    include 'creds.php';
    $conn = new mysqli($host, $user, $passwd, $db);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $enter = "insert into queries(tcode,question) values(?,?)";
    $stmt = $conn->prepare($enter);
    $stmt->bind_param("ss", $tcode, $question);
    if($stmt->execute()){
        echo "Query recieved!";
    } else {
        echo "An unknown error occured.";
    }
} else {
    echo "Invalid Request";
}
?>
