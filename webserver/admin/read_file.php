<?php
include 'auth_admin.php';
include 'creds.php';
$file = 'uyi7y8787tyguhjhg876/test.txt';

if (file_exists($file)) {
    $content = file_get_contents($file);
    if($content == "c2h1cnUgaG8gZ2F5YSBiZW5jaG8="){
        echo json_encode(['content' => "ON"]);
    } else {
    echo json_encode(['content' => 'OFF']);
    }
}else{
    echo "ERROR!";
}
?>
