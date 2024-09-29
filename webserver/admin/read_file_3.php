<?php
include 'auth_admin.php';
include 'creds.php';
$file = 'uyi7y8787tyguhjhg876/commsen.txt';

if (file_exists($file)) {
    $content = file_get_contents($file);
    if($content == "yes"){
        echo json_encode(['content' => "ON"]);
    } else {
    echo json_encode(['content' => 'OFF']);
    }
}else{
    echo "ERROR!";
}
?>
