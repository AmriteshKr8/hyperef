<?php
include 'creds.php';
$conn = new mysqli($host, $user, $passwd, $db);

if ($conn->connect_error) {
    die("Connection failed: ". $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $schoolcode = trim($_POST['schoolcode']);
    $upassword = trim($_POST['password']);;
    $stmt = $conn->prepare("SELECT password FROM users WHERE schoolcode =?");
    $stmt->bind_param("s", $schoolcode);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Fetch data from the result set
        $row = $result->fetch_assoc();
        $password = $row['password'];
    }
    if ($upassword === $password) { // Use password_verify for comparison
        $dataToStore = base64_encode($schoolcode."^".$password);
        setcookie("key", $dataToStore);
        header('Location: index.php');
    } else {
        header('Location: login.html');
    }
}

$conn->close();
?>