<?php
include 'auth_admin.php';
include 'creds.php';
$file = 'uyi7y8787tyguhjhg876/format.txt';

if (file_exists($file)) {
    $content = file_get_contents($file);
    if($content == "blitz"){
        echo json_encode(['content' => "BLITZ"]);
    } else {
    echo json_encode(['content' => 'NORMAL']);
    }
}else{
    echo "ERROR!";
}
?>
